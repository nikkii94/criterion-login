#PHP Login System

##Install

Configure webserver to point criterion-login/public directory.

Example **httpd-vhosts.conf**
````
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/criterion-login/public"
    ServerName criterion-login.local
    <Directory "C:/xampp/htdocs/criterion-login/public">
    </Directory>
</VirtualHost>
````
**hosts file:**
```
127.0.0.1       criterion-login.local
```

Example data hosted in **dump.sql**

##Database

MySQL connection informations hosted in **config/DB.php**
```
private $host       = 'localhost';
private $db_name    = 'php-login-system';
private $username   = 'root';
private $password   = '';
```

##Assets

For install frontend dependencies (jquery, bootstrap) run:

`yarn` or
`npm install`


##Technology
- Apache 2.4.33
- PHP version: 5.6.36
- MariaDB 10.1.32 (MySQL)
- (xampp v3.2.2)


- jQuery@3.3.1
- Bootstrap@4.1.1
