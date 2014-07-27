# Introduction

The main goal of this web application is to give a place where users can upload and download resources.

**Try it online** : http://uniboxaq.altervista.org/ [v0.1](https://github.com/davcri/Unibox-Ajax/releases/tag/v0.1)

Unibox is a web application developed developed by [davcri](https://github.com/davcri) and [filreg](https://github.com/filreg) for an Italian college project. The purpose of the course was to learn the basics of web languages such as PHP, MySQL, JavaScript and the principles of software engineering (MVC pattern). 

_**Note**: All the web application user interface is in Italian, but both code and documentation are in English. We hope to have time to finish this application and translate it._


# Documentation 

**PHP** : http://uniboxaq.altervista.org/Documentation/PHP/

**UML Diagrams and XMI file** : Can be found in ```Documentation/UML/ ```

Look: [The readme in ```Documentation/UML/```](https://github.com/davcri/Unibox-Ajax/tree/master/Documentation/UML%20Diagrams) for more info.

# File hierarchy

* `Classes/` : Contains the server side application. All the PHP classes are here.
* `Configuration Files/` : Contains the configuration file of the application. Generally you don't need to edit these files.
* `Documentation/` : Contains all the documentation stuff as PHPDoc and UML diagrams.  
* `Library/` : Contains all the required external libraries. 
* `Resources/` : By default, Unibox moves the uploaded resources here.
* `Smarty Dir/` : Contains the required smarty folders and also all the .tpl, css, javascript and images ! 
  * `Smarty Dir/templates/` : All the tpl files are here.
  * `Smarty Dir/templates/javascript/` : All the javascript files are here.
  * `Smarty Dir/templates/css` : All the css files are here. 
  

# Installation
**Requirements**

Unibox runs on server that supports :
* Apache
* mysql
* php

It hasn't been tested on others HTTP server.

**Installation steps**

If you want to install Unibox follow these steps :

1. Create an empty database on your DBMS (ie: 'mysql') and name it as you want (ie: ```unibox```).
2. Put all the source code in a folder accessible from your HTTP server (remote host or local host).  
3. Open the browser and go to the path where you stored the source code (ie: ```localhost/path/to/unibox```) 
4. Follow the guided installation. 

Now the installation is complete. Refresh the page and start using Unibox !

If something goes wrong you should check if you have write permission for all users on ```Configuration Files``` directory. 
If you're on a Unix PC and you're trying to install Unibox in your localhost, you should try to run the ```permissionScript.sh``` with administrative priviledges.

**Reinstallation**

You can repeat the installation procedure by deleting ```Configuration Files/databaseConfig.php``` file and dropping the old database. 


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
