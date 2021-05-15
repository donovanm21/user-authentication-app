# Application Setup

1. Setup a MySQL Database & Import the sample database

Import the databse.sql in MySQL 

2. Copy config-new.php to config.php and update the below in config.php

```php
// Database Host Details
$DBSERVER = 'server host name'; // Hostname for the MySQL server
$DBUSER = 'username'; // Username to access MySQL
$DBPASS = 'password'; // Password to access MySQL
$DBNAME = 'librarydb'; // Name of database you using for the app
```

3. Copy all the files to your ftp / web server root folder

4. Visit the site and login with the below default details

Default login details admin / admin
