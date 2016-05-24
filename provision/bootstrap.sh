#!/bin/bash

# timezone
echo "Europe/Paris" | sudo tee /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

# update package
apt-get update

# install basic tools
apt-get install -y curl
apt-get install -y git
apt-get install -y htop
apt-get install -y net-tools
apt-get install -y vim
apt-get install -y wget

# install apache2
apt-get install -y apache2

# configure apache2 server name
cp /vagrant/provision/servername.conf /etc/apache2/conf-available/servername.conf
ln -s /etc/apache2/conf-available/servername.conf /etc/apache2/conf-enabled/servername.conf

# restart apache2
service apache2 restart

# run apache2 with user vagrant and group vagrant
sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=vagrant/" /etc/apache2/envvars
sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=vagrant/" /etc/apache2/envvars

chown -R vagrant:vagrant /var/lock/apache2
chown -R vagrant:vagrant /var/log/apache2

# enable module
a2enmod rewrite

# install mysql
# password: root
echo mysql-server mysql-server/root_password password root | sudo debconf-set-selections
echo mysql-server mysql-server/root_password_again password root | sudo debconf-set-selections
apt-get install -y mysql-server
apt-get install -y mysql-client

# configure mysql
sed -i "s/^bind-address/# bind-address/" /etc/mysql/my.cnf
mysql -h localhost -u root --password=root < /vagrant/provision/root-access.sql

# create user and database
mysql -h localhost -u root --password=root < /vagrant/provision/create-user-and-db.sql

# restart mysql
service mysql restart

# add php 5.6 repo
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5-5.6
apt-get update

# install php5
apt-get install -y php5
apt-get install -y php-apc
apt-get install -y php5-curl
apt-get install -y php5-gd
apt-get install -y php5-intl
apt-get install -y php5-mysql
apt-get install -y php5-xdebug

# configure php5
sed -i "s/\;date\.timezone\ \=/date\.timezone\ \=\ Europe\/Paris/g" /etc/php5/apache2/php.ini
sed -i "s/\;date\.timezone\ \=/date\.timezone\ \=\ Europe\/Paris/g" /etc/php5/cli/php.ini
# sed -i "s/\;date\.timezone\ \=/date\.timezone\ \=\ Europe\/Paris/g" /etc/php5/fpm/php.ini
sed -i "s/display_errors = Off/display_errors = On/" /etc/php5/apache2/php.ini
sed -i "s/display_startup_errors = Off/display_startup_errors = On/" /etc/php5/apache2/php.ini
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/log_errors = Off/log_errors = On/" /etc/php5/apache2/php.ini
sed -i "s/log_errors_max_len = .*/log_errors_max_len = 0/" /etc/php5/apache2/php.ini

# configure xdebug
echo -e "\n\
xdebug.max_nesting_level=1000\n\
\n\
xdebug.scream=1\n\
\n\
; xdebug.remote_autostart=1\n\
xdebug.remote_connect_back=1\n\
xdebug.remote_enable=1\n\
xdebug.remote_handler=dbgp\n\
xdebug.remote_port=9000\n\
\n\
; xdebug.profiler_enable=1\n\
xdebug.profiler_output_dir=/var/www/website/logs\n\
" | sudo tee -a /etc/php5/apache2/conf.d/20-xdebug.ini

# disable default web site
mkdir -p /var/www/default/html
mv /var/www/html/index.html /var/www/default/html/
rmdir /var/www/html
rm /etc/apache2/sites-enabled/000-default.conf

# prepare web site directory structure
service apache2 stop
umount /var/www/website
mkdir -p /var/www/website
mkdir -p /var/www/website/cgi-bin
mkdir -p /var/www/website/logs
mkdir -p /var/www/website/web
chown -R vagrant:vagrant /var/www/website
mount -t vboxsf -o rw,uid=vagrant,gid=vagrant vagrant /var/www/website

# enable web site virtual host
cp /vagrant/provision/website-php-mod.conf /etc/apache2/sites-available/website.conf
ln -s /etc/apache2/sites-available/website.conf /etc/apache2/sites-enabled/website.conf
# restart apache2
service apache2 restart

