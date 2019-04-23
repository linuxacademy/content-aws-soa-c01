#!/bin/bash
yum update -y
isl2=`uname -a| grep amzn2`
if [ "$isl2" != "" ] ; then
  amazon-linux-extras install -y lamp-mariadb10.2-php7.2 php7.2
  yum install -y httpd mariadb-server git
else
  yum install -y httpd24 php70 mysql56-server php70-mysqlnd git
fi
cd /var/www/html
git clone https://github.com/linuxacademy/content-aws-sysops-administrator.git
cd content-aws-sysops-administrator/wp-site/
mv * /var/www/html
groupadd www
usermod -a -G www ec2-user
chown -R root:www /var/www
chmod -R 2775 /var/www
echo '<?php phpinfo(); ?>' > /var/www/html/phpinfo.php
service httpd start
chkconfig httpd on
if [ "$isl2" != "" ] ; then
  service mariadb start
  chkconfig mariadb on
else
  service mysqld start
  chkconfig mysqld on
fi
