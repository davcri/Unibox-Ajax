# Unibox README


# Introduction

Unibox is a web application developed for an Italian college project.

_**Note**: All the web application user interface is in Italian, but both code and documentation are in English. I hope to have time to finish this application and translate it._

The main goal of this web application is to give a place where users can upload and download resources.

# Installation (local installation)
If you want to install Unibox on your pc follow these steps :

1. Create an empty database on your DBMS (ie: 'mysql') and name it as you want (ie: ```unibox```).
2. Put all the source code in a folder accessible from the web. You can do that by putting the source code in your HTTP server's document root. 
3. Open the browser and go to the path where you stored the source code (ie: ```localhost/path/to/unibox```) 
4. Follow the guided installation.

If something goes wrong you should check if you have write permission for all users on ```configurationFiles``` directory. If you're on a Unix PC you should try to run the ```permissionScript.sh``` with administrative priviledges.

**Reinstallation**

You can repeat the installation procedure by deleting ```configurationFiles/databaseConfig.php``` file.

# Development 
We developed Unibox using : 

* XAMPP : [2014-02-13] XAMPP for Linux 64bit 1.8.3-3
This version of XAMPP includes:
  - Updated PHP to 5.5.9
  - Updated MySQL to 5.6.16
  - phpMyAdmin 4.1.6
  - Server web : Apache/2.4.7 (Unix)
* Smarty-3.1.17
* Jquery 1.10 + JqueryUI 1.10
* Bootstrap 3 
* tablesorter 2.17.4 : https://github.com/Mottie/tablesorter/tree/6de1009af887e6023f414a99a4b97189e3640275
* jquery.blockUI 2.66.0: https://github.com/malsup/blockui/

A big thanks to all the guys behind these wonderful tools. 
