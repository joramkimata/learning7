# Install Apache, PHP and MySQL

1. apt update
2. apt install apache2 apache2-utils curl mysql-server mysql-client php libapache2-mod-php php-mysql php-common php-mbstring php-xmlrpc php-soap php-gd php-xml php-mysql php-cli php-mcrypt php-zip -y
3. access http://<IP> 

## Install Composer

1. apt install composer
2. Then run composer

## Install Laravel 

1. cd /var/www/
2. Using git or filezilla

## Configure Apache

1. Edit ```nano /etc/apache2/sites-enabled/000-default.conf```
2. add ```DocumentRoot /var/www/project/public```
3. Setup server to accept .htaccess file as shown below

```
<Directory /var/www/project/public>
        Require all granted
        AllowOverride All
</Directory>
```

4. Enable rewrite module ```a2enmod rewrite```
5. Confirm everything is OK!, ```apachectl configtest``` && ```apachectl restart```
6. Access the project again, ```http://<IP>```

## Configure MySQL

1. mysql_secure_installation
2. mysql -u root -p
3. nano /var/www/project/.env

                
