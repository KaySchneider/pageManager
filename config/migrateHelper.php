<?php
/**
 *this file contains some defines wich are for the
 * migration time.. while not every class implements the
 * config classes by itselfs 
 */
define('APP_API_KEY', AppInfo::appID());
define('APP_SECRET', AppInfo::appSecret());
define('APP_ID', APP_API_KEY);

define('DB_USER', AppInfo::dataBaseUser());
define('DB_HOST', AppInfo::dataBaseHost());
define('DB_PASS', AppInfo::dataBasePass());
define('DB_BASE', AppInfo::dataBaseBase());

//var_dump(DB_USER,DB_HOST,DB_PASS,DB_BASE);
?>
