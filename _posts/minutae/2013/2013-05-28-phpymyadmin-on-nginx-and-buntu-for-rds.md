---
title: "PHPMyAdmin On Nginx (on Ubuntu) For RDS"
category: minutae
layout: post
---

### Installing PHPMyAdmin

An example using conditional filter expressions that have multiple conditional
paths. Here is a simple conditional that can quickly become a drain on
performance because of the order of parsing;

```bash
$ apt-get install phpmyadmin
```

Preconfigure with `apache` or `lighttpd`? - I hit `ESC`.

Configure database for phpmyadmin with dbconfig-common? No.

### Configure Amazon RDS

> The one thing I had trouble with was the DB Security Group setup.  When you go
> to add access for an CIDR/IP it provides a recommended value.  It took some
> messing around to determine that this default value isn't actually what needed
> to be there.  If you're not able to connect to your instance when it's all
> said and done, be sure to double check this value. The IP they provided did
> not match the IP address that was provided to us by our ISP.  Once you've
> created your DB Instance and setup the security group you're good to go.

In summary, just add your EC2 Security group ... i.e. the one that you want to
be able to access RDS.

### Configure PHPMyAdmin

Modify `/etc/config.inc.php`. It should look something like this.

```php
/* Configure according to dbconfig-common if enabled */
if (!empty($dbname)) {
  /* Authentication type */
  $cfg['Servers'][$i]['auth_type'] = 'config';
  $cfg['Servers'][$i]['user'] = 'YOUR_USERNAME';
  $cfg['Servers'][$i]['password'] = 'YOUR_PASSWORD';
  $cfg['Servers'][$i]['hide_db'] = '(mysql|information_schema|phpmyadmin)';

  /* Server parameters */
  if (empty($dbserver)) $dbserver = 'localhost';
  $cfg['Servers'][$i]['host'] = $dbserver;

  if (!empty($dbport)) {
      $cfg['Servers'][$i]['connect_type'] = 'tcp';
      $cfg['Servers'][$i]['port'] = $dbport;
  }
  //$cfg['Servers'][$i]['compress'] = false;

  /* Select mysqli if your server has it */
  $cfg['Servers'][$i]['extension'] = 'mysqli';

  /* Optional: User for advanced features */
  //$cfg['Servers'][$i]['controluser'] = $dbuser;
  //$cfg['Servers'][$i]['controlpass'] = $dbpass;

  /* Optional: Advanced phpMyAdmin features */
  $cfg['Servers'][$i]['pmadb'] = $dbname;
  $cfg['Servers'][$i]['bookmarktable'] = 'pma_bookmark';
  $cfg['Servers'][$i]['relation'] = 'pma_relation';
  $cfg['Servers'][$i]['table_info'] = 'pma_table_info';
  $cfg['Servers'][$i]['table_coords'] = 'pma_table_coords';
  $cfg['Servers'][$i]['pdf_pages'] = 'pma_pdf_pages';
  $cfg['Servers'][$i]['column_info'] = 'pma_column_info';
  $cfg['Servers'][$i]['history'] = 'pma_history';
  $cfg['Servers'][$i]['designer_coords'] = 'pma_designer_coords';

  /* Uncomment the following to enable logging in to passwordless accounts,
   * after taking note of the associated security risks. */
  // $cfg['Servers'][$i]['AllowNoPassword'] = TRUE;

  /* Advance to next server for rest of config */
  $i++;
}

$cfg['Servers'][$i]['auth_type'] = 'HTTP';
$cfg['Servers'][$i]['hide_db'] = '(mysql|information_schema|phpmyadmin)';
$cfg['Servers'][$i]['host'] = 'EXAMPLE.JUMBLE.us-east-1.rds.amazonaws.com';
```

### Configure Nginx

Add serverblock to Nginx config.

```nginx
server {
  listen 80;
  server_name YOUR.DOMAIN.DOT;
  index index.php;
  root /usr/share/phpmyadmin;

  location / {
    try_files $uri $uri/ @phpmyadmin;
  }

  location @phpmyadmin {
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_param SCRIPT_FILENAME /usr/share/phpmyadmin/index.php;
    include /etc/nginx/fastcgi_params;
    fastcgi_param SCRIPT_NAME /index.php;
  }

  location ~ \.php$ {
    try_files $uri @phpmyadmin;
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index  index.php;
    fastcgi_param  SCRIPT_FILENAME  /usr/share/phpmyadmin$fastcgi_script_name;
    include        fastcgi_params;
  }
}
```

---

1. There's the assumption that you already have Nginx up and running on an
   Ubuntu box.
2. This was done practially on Ubuntu 13.04
3. [Ubuntu Community Help Wiki: phpMyAdmin][1]
4. [Installing Nginx With PHP5 (And PHP-FPM) And MySQL Support (LEMP) On Ubuntu
   12.10][2]
5. [How to remotely manage an Amazon RDS instance with PHPMyAdmin][3]

[1]: https://help.ubuntu.com/community/phpMyAdmin
[2]: http://www.howtoforge.com/installing-nginx-with-php5-and-php-fpm-and-mysql-support-lemp-on-ubuntu-12.
[3]: http://blog.benkuhl.com/2010/12/how-to-remotely-manage-an-amazon-rds-instance-with-phpmyadmin/
