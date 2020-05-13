
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

