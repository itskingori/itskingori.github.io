---
title: "Nginx With PHP5 (And PHP-FPM) on Ubuntu 13.04"
category: minutae
layout: post
---

Having a working install of Ubuntu 13.04, proceed with the below;

#### 1. Update and upgrade Ubuntu

```bash
$ sudo apt-get update
$ sudo apt-get upgrade
```

#### 2. Install Nginx

```bash
$ sudo apt-get install nginx
$ sudo /etc/init.d/nginx start
```

Nginx should be working now. Try access the server from a browser.

#### 3. Install PHP-FPM

PHP-FPM is a daemon process (with the init script `/etc/init.d/php5-fpm`) that
runs a FastCGI server on the socket `/var/run/php5-fpm.sock`.

```bash
$ sudo apt-get install php5-fpm
```

Now create the following PHP file in the document root /usr/share/nginx/www

```bash
$ vim /usr/share/nginx/www/info.php
```

``` php
// Enclosed in PHP tags of course
phpinfo();
```

_Ps: See [link 1][1] below for more detail & some other extra stuff you could
do._

---

1. [Installing Nginx With PHP5 (And PHP-FPM) And MySQL Support (LEMP) On Ubuntu 12.10][1]

[1]: http://www.howtoforge.com/installing-nginx-with-php5-and-php-fpm-and-mysql-support-lemp-on-ubuntu-12.10
