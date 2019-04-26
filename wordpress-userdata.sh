#!/bin/bash -xe

yum update -y

# Check Amazon Linux 1 or 2
isl2=$(uname -a| grep amzn2)

if [ "$isl2" != "" ] ; then
  # Amazon Linux 2
  amazon-linux-extras install -y lamp-mariadb10.2-php7.2 php7.2
  yum install -y httpd mariadb-server
else
  # Amazon Linux 1
  yum install -y httpd24 php70 mysql56-server php70-mysqlnd
fi

groupadd www
usermod -a -G www ec2-user

# Download wordpress site & move to /var/www/html
cd /var/www/
curl -O https://wordpress.org/latest.tar.gz && tar -zxf latest.tar.gz
rm -rf /var/www/html
mv wordpress /var/www/html

# Set the permissions
chown -R root:apache /var/www
chmod 2775 /var/www
find /var/www -type d -exec chmod 2775 {} +
find /var/www -type f -exec chmod 0664 {} +

echo '<?php phpinfo(); ?>' > /var/www/html/phpinfo.php
service httpd start
chkconfig httpd on

if [ "$isl2" != "" ] ; then
  # Amazon Linux 2
  service mariadb start
  chkconfig mariadb on
else
  # Amazon Linux 1
  service mysqld start
  chkconfig mysqld on
fi
