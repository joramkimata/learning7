
# How to Install Laravel on Ubuntu 20.04 - Using Apache2

#### Requirements

- Git on linux server if not found run

```
sudo apt install git
```

## Step 1 – Installing LAMP Stack

### Install PHP

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt install -y php7.4 php7.4-gd php7.4-mbstring php7.4-xml
```

### Apache2

```
sudo apt install apache2 libapache2-mod-php7.4
```

### Install MySQL

```
sudo apt install mysql-server php7.4-mysql
```

### Secure MySQL Server

```
sudo mysql_secure_installation
```

- Even though you configured a password above, when you run the commands below you will be granted access without requiring a password.

```
sudo mysql
```

- You’ll automatically be granted access.
- This happens because the current version 8.0 comes with a feature that provides root authentication via a ``auth_socket`` plugin.
- This plugin authenticates users who connect from the localhost via socket file without prompting or a password.
- This can cause issues with some apps that need to connect to the database via root. To fix that, you’ll need to change the default authentication mechanism from ``auth_socket`` to ``mysql_native_password``.
- Login back into MariaDB console.

```
sudo mysql
```

-  check which authentication method each of your MySQL user accounts use with the following command

```
SELECT user,authentication_string,plugin,host FROM mysql.user;
```

-  you can see that the root user does in fact authenticate using the auth_socket plugin.

```
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';

```

- Then, run FLUSH PRIVILEGES which tells the server to reload the grant tables and put your new changes into effect:

```
FLUSH PRIVILEGES;
```

- You should be prompted for password when you want to access MariaDB console.

```
sudo mysql -u root -p
```

- Since you don’t want to use MariaDB root user for external applications to connect, you should probably create an admin account separate from the root user.

```
GRANT ALL PRIVILEGES ON *.* TO 'superadmin'@'localhost' IDENTIFIED BY 'very_strong_password';
```

### Install phpMyAdmin

```
sudo apt install phpmyadmin
```

- When prompted to choose the webserver, selecat ``apache2`` and continue.
- When prompted again to allow debconfig-common to install a database and configure select ``No``.
- Now, open your web browser and login to the server ``hostname or IP address`` followed by ``phpmyadmin`` i.e `` http://<ip-address>/phpmyadmin``

## Step 2 – Installing Composer

```
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
```

## Step 3 – Install Laravel project i.e TodoApp

```
cd /var/www
git clone <todoapp-git-repo>.git
```

```
cd /var/www/<todoapp-git-repo>
sudo composer install
```
If you find any error please run the following

```
apt install php7.4-zip
```

```
chown -R www-data.www-data /var/www/<todoapp-git-repo>
chmod -R 755 /var/www/<todoapp-git-repo>
chmod -R 777 /var/www/<todoapp-git-repo>/storage
```

## Configure Apache

Open the following file with your favourite text editor:

```
nano /etc/apache2/sites-enabled/000-default.conf
```

- Adjust the document root with the correct path to your Laravle public folder:

```
DocumentRoot /var/www/<todoapp-git-repo>/public
```

- Setup the server to accept the .htaccess file

```
<Directory /var/www/project/public>
        Require all granted
        AllowOverride All
</Directory>
 ```
 
 - After that we have to enable mod_rewrite, we can do that with this command here:
 
 ```
 a2enmod rewrite
 ```
 
 - After those changes make sure to run a config test and then restart apache
 
 ```
 apachectl configtest
 ```
 
 - Restart Apache:
 
 ```
 apachectl restart
 ```
 

## Step 4 – Create Environment Settings

```
mv .env.example .env
```

```
php artisan key:generate
```

## Step 5 – Create MySQL User and Database

```
CREATE DATABASE laravel;
CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'secret';
GRANT ALL ON laravel.* to 'laravel'@'localhost';
FLUSH PRIVILEGES;
quit
```

### Then edit .env on db connection part

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

