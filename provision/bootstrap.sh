#!/bin/bash

# update package
apt-get update

# install apache2
apt-get install -y apache2

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
add-apt-repository -y ppa:ondrej/php5-oldstable
apt-get update

# install php5.4
apt-get install -y php5
apt-get install -y php-apc
apt-get install -y php5-curl
apt-get install -y php5-gd
apt-get install -y php5-intl
apt-get install -y php5-mysql
apt-get install -y php5-xdebug

# configure apache2
cp /vagrant/provision/servername.conf /etc/apache2/conf.d/servername.conf

# disable default web site
mkdir /var/www/default
mv /var/www/index.html /var/www/default/
rm /etc/apache2/sites-enabled/000-default

# enable project web site
cp /vagrant/provision/website.conf /etc/apache2/sites-available/website.conf
ln -s /vagrant /var/www/website
ln -s /etc/apache2/sites-available/website.conf /etc/apache2/sites-enabled/website.conf

# restart apache2
service apache2 restart

