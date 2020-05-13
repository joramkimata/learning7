
# How to Install Laravel on Ubuntu 20.04 - Using Apache2

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

- Then run the commands below to change to disable mysql_native_password module..

```
USE mysql;
UPDATE user SET plugin='' WHERE user ='root';
```

- The save your changes and exit:

```
FLUSH PRIVILEGES;
EXIT;
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

```
chown -R www-data.www-data /var/www/<todoapp-git-repo>
chmod -R 755 /var/www/<todoapp-git-repo>
chmod -R 777 /var/www/<todoapp-git-repo>/storage
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

