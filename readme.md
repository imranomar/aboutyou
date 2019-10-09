<p align="center">
<h1>About You - Matrix Multiplication</h1>

<p align="center">
    
Introduction
=============

Api takes 2 matrices and multiplies them and returns the result. End point http://34.228.226.254/public/api/multiply

Api introduces another faster multiplication algo that multiplies in 1/4th of the time to linear multiplication.  (<i> Had time so was thinking about how could the algo be made more efficient</i> ). End point  http://34.228.226.254/public/api/multiplyquick

API Documentation
=============

NOTE: Has been created with Laravel 5.8 , PHP 7.2

NOTE: Api documentation can be found here at:

https://documenter.getpostman.com/view/7566754/SVtSV9N5?version=latest

NOTE: Api Export For Postman can be found here at:

http://34.228.226.254/public/aboutyou.postman.json

CONFIGURATION
-------------
Database configuration can be found in .env file in root

DATABASE
--------
.migrations can be found in database>migrations . Install with running php artisan migrate in root of app

FILE PERMISSIONS
----------------
Make sure the following are writable:

/storage/logs 

/storage/framework

TO INSTALL
----------
Requirements: php7, composer, mysql, nodejs, npm

.run 'composer install'

.run 'npm install'

.setup the .env file for your database settings and create the database

.run 'php artisan migrate'

AUTHORIZATION
-------------
The app uses Basic Auth. ( I can easily switch it to Token based or Passport OAuth ). Can use the following credentials online

username: imranomar@gmail.com

password: qweqwe123

<img src = "http://34.228.226.254/public/capture.png">

A new user can be created at the end point: http://34.228.226.254/public/api/register

Required fields are name, email, password, password_confirmation

<img src = "http://34.228.226.254/public/capture2.png">

Basic Auth uses the email and password base64 encoded. 

e.g. base64_encode("imranomar@gmail.com:qweqwe123");

<b>Sample Header Contents</b>

[authorization] => Basic aW1yYW5vbWFyQGdtYWlsLmNvbTpxd2Vxd2UxMjM= [accept] => application/json [content-type] => application/x-www-form-urlencoded [php-auth-user] => imranomar@gmail.com [php-auth-pw] => qweqwe123 ) 

UNIT TESTS
---------------------------
.can be found in /tests/Unit
.can be run with 'phpunit' (/vendor/bin/phpunit) in the root

</p>

Please feel free to contact me :

Imran Omar Bukhsh<br>
Email: imranomar@gmail.com<br>
Mobile: 00971 50 4225054<br>
