---
title: "Nginx With PHP5 (And PHP-FPM) on Ubuntu 13.04"
category: minutae
---

Having a working install of Ubuntu 13.04, proceed with the below;

####1. Update and upgrade Ubuntu####

<pre class="brush: bash">
$ sudo apt-get update
$ sudo apt-get upgrade
</pre>

####2. Install Nginx####

<pre class="brush: bash">
$ sudo apt-get install nginx
$ sudo /etc/init.d/nginx start
</pre>

Nginx should be working now. Try access the server from a browser.

####3. Install PHP-FPM####

PHP-FPM is a daemon process (with the init script `/etc/init.d/php5-fpm`)
that runs a FastCGI server on the socket `/var/run/php5-fpm.sock`.

<pre class="brush: bash">
$ sudo apt-get install php5-fpm
</pre>

Now create the following PHP file in the document root /usr/share/nginx/www

<pre class="brush: bash">
$ vim /usr/share/nginx/www/info.php
</pre>

<pre class="brush: php">
// Enclosed in PHP tags of course
phpinfo();
</pre>

_Ps: See [link 1][1] below for more detail & some other extra stuff you
could do._

<div markdown="1" class="post-footnotes">
1. [Installing Nginx With PHP5 (And PHP-FPM) And MySQL Support (LEMP) On Ubuntu 12.10][1]
</div>

[1]: http://www.howtoforge.com/installing-nginx-with-php5-and-php-fpm-and-mysql-support-lemp-on-ubuntu-12.10
