#!/bin/bash

# update package
apt-get update

# install git
apt-get install -y git

# Réglage de la zone horaire du serveur
echo "Europe/Paris" > /etc/timezone

# Modifier php.ini pour la timezone PHP
sed -ie 's/\;date\.timezone\ \=/date\.timezone\ \=\ Europe\/Paris/g' /etc/php5/cli/php.ini
sed -ie 's/\;date\.timezone\ \=/date\.timezone\ \=\ Europe\/Paris/g' /etc/php5/apache2/php.ini

# install apache2
apt-get install -y apache2

# configure apache2 server name
cp /vagrant/provision/servername.conf /etc/apache2/conf-available/servername.conf
ln -s /etc/apache2/conf-available/servername.conf /etc/apache2/conf-enabled/servername.conf

# run apache2 with user vagrant and group vagrant
sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=vagrant/" /etc/apache2/envvars
sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=vagrant/" /etc/apache2/envvars

chown vagrant:vagrant -R /var/log/apache2
chown vagrant:vagrant -R /var/lock/apache2

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

# add repo php5.4
apt-get install -y python-software-properties
add-apt-repository -y ppa:ondrej/php5-5.6
apt-get update

# install php5.4
apt-get install -y php5
apt-get install -y php-apc
apt-get install -y php5-curl
apt-get install -y php5-gd
apt-get install -y php5-intl
apt-get install -y php5-mysql
apt-get install -y php5-xdebug

# disable default web site
mkdir -p /var/www/default/html
mv /var/www/html/index.html /var/www/default/html/
rmdir /var/www/html
rm /etc/apache2/sites-enabled/000-default.conf

# enable project web site
service apache2 stop
umount /var/www/website
cp /vagrant/provision/website.conf /etc/apache2/sites-available/website.conf
ln -s /etc/apache2/sites-available/website.conf /etc/apache2/sites-enabled/website.conf
mkdir -p /var/www/website
mkdir -p /var/www/website/logs
mkdir -p /var/www/website/web
chown -R vagrant:vagrant /var/www/website
mount -t vboxsf -o rw,uid=vagrant,gid=vagrant vagrant /var/www/website

# restart apache2
service apache2 restart


