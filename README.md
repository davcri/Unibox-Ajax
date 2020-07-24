## Disclaimer

**Unibox is not maintained anymore**

It was created for a University course about Web Programming. The purpose of this webapp was to practice with web technologies such as PHP, MySQL, JavaScript, HTML, CSS and the principles of software engineering (MVC pattern). 

---

# Introduction

Unibox is a web application where users can upload and download resources.

Unibox was developed by [davcri](https://github.com/davcri) and [filreg](https://github.com/filreg). 

**Try it online** [v0.1.2](https://github.com/davcri/Unibox-Ajax/releases/tag/v0.1.2): http://uniboxaq.altervista.org/ 

_**Note**: All the web application user interface is in Italian, but both code and documentation are in English._
 
# Documentation 

**PHP** : http://uniboxaq.altervista.org/Documentation/PHP/

**UML Diagrams and XMI file** : Can be found in ```Documentation/UML/ ```. Look: [The readme in ```Documentation/UML/```](https://github.com/davcri/Unibox-Ajax/tree/master/Documentation/UML%20Diagrams) for more info.

# File hierarchy

* `Classes/` : Contains the server side application. All the **PHP** classes are here.
* `Configuration Files/` : Contains the configuration file of the application. Generally you don't need to edit these files.
* `Documentation/` : Contains all the documentation stuff as **PHPDoc** and UML diagrams.  
* `Library/` : Contains all the required external libraries. 
* `Resources/` : By default, Unibox moves the uploaded resources here.
* `Smarty_dir/` : Contains the required smarty folders and also all the **.tpl**, **css**, **javascript** and images ! 
  * `Smarty_dir/templates/` : All the tpl files are here.
  * `Smarty_dir/templates/javascript/` : All the javascript files are here.
  * `Smarty_dir/templates/css` : All the css files are here. 
  

# Installation
**Requirements**

Unibox runs on server that supports :
* Apache
* mysql
* php

It hasn't been tested on others HTTP server.

**Installation steps**

If you want to install Unibox follow these steps :

1. Run ```permissionScript.sh``` with administrative priviledges. It will sets all the required permissions:  
  * ```Configuration Files``` : rwx for others
  * ```Smarty_dir/templates_c``` : rwx for others
  * ```Smarty_dir/cache``` : rwx for others
  * ```Resources``` : rwx for others
5. Follow the guided installation. 
2. Create an empty database on your DBMS ('mysql') and name it as you want (ie: ```unibox```).
3. Put all the source code in a folder accessible from your HTTP server.
4. Open the browser and go to the path where you stored the source code (ie: ```docmuentRoot/path/to/unibox```)

Now the installation is complete. Refresh the page and start using Unibox !

If something goes wrong you should check if you have write permission for all users on ```configurationFiles``` directory. 
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
