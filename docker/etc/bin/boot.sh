#!/bin/bash

#echo 'INSIDE CONTAINER STEP 1 : install npm'
npm install /var/www/html

#echo 'INSIDE CONTAINER STEP 4 : install composer'
composer install

#echo 'INSIDE CONTAINER STEP 5 : run grunt'
#grunt

#echo 'INSIDE CONTAINER STEP 6 : try to remove apache existing pid file'
#if [ -f "$APACHE_PID_FILE" ]; then
#	rm "$APACHE_PID_FILE"
#fi


#echo 'STEP 5 : fixe PHP7 Zend lib by replace it manually';
#cp -f 'php7fixes/zend-session/src/AbstractContainer.php' 'vendor/zendframework/zend-session/src/AbstractContainer.php'

echo 'INSIDE CONTAINER STEP 7 : run apache'
apachectl -k start -DFOREGROUND