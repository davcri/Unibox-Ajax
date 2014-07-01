#!/bin/bash
#
# This script sets all the required permissions to run the web application smoothly
# Just put it in the Unibox root folder, make it executable and run it :)
#

clear

listPermission='ls -dlh Resources Smarty_dir/templates Smarty_dir/templates_c Smarty_dir/cache'

printf "Starting script. Permission before :\n"

$listPermission
permissionBefore=$($listPermission)

chmod +777 Resources Smarty_dir/templates_c Smarty_dir/cache "Configuration Files"
chmod o+r -R Smarty_dir/templates
chmod o+x Smarty_dir/templates/css Smarty_dir/templates/img
chmod o+r -R Smarty_dir/templates/css Smarty_dir/templates/img

permissionAfter=$($listPermission)

printf "\n"

printf "Script ended. Now the permissions are :\n"
$listPermission

printf "\nWhat has changed :\n"
diff <(echo "$permissionBefore") <(echo "$permissionAfter")

read -n1 -r -p "Press any key to continue..."
