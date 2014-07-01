# Unibox README

# Introduction

Unibox is a work in progress web application developed as universitary project.

The main goal of this web application is to give a place where users can upload
or download resources organized by degree course.


# Installation
Note : this app is currently under heavy development.
We are using
* XAMPP : [2014-02-13] XAMPP for Linux 64bit 1.8.3-3
This version of XAMPP includes:
  - Updated PHP to 5.5.9
  - Updated MySQL to 5.6.16
  - phpMyAdmin 4.1.6
  - Server web : Apache/2.4.7 (Unix)
* Smarty-3.1.17

In order to run smoothly this application you need to :

1. Import `Unibox.sql` script to create the database. Assuming you are using mysql, you can do that in 2 ways:
  1. __phpMyAdmin__ : From the GUI, click on the `import` tab and import `Unibox.sql`.
  2. __Terminal__ : Open the terminal in the Unibox folder, then : `mysql db_name < Unibox.sql`. Look at the official documentation for details : http://dev.mysql.com/doc/refman/5.6/en/mysql-batch-commands.html
2. Go in ___/Configuration Files___ and rename `databaseConfig.example.php` in `databaseConfig.php`.
3. In the file just renamed, change the values of the array $mysqlConfig according to your mysql database configuration.
