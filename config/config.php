<?php

/*
 * change the most config for an fast and easy way to work with heroku!!
 * Make some magic things in the config.. so that we even dont must edit this any more
 * things like database and so on...
 * 
 */

define('PROJEKT_NAME', 'snipFrame');
define('BASEPATH', dirname(dirname(__FILE__)));
define('CSS_DIR', 'css' . DIRECTORY_SEPARATOR);
//facebook stuff
//define('CANVAS_URL', "https://apps.facebook.com/pagehelper/");
define('CANVAS_URL', "http://apps.facebook.com/pagemanagerdev/");
define('FACEBOOK_REG_PERMS', 'manage_pages');
//facebook stuff ends here
//setting development stuff
define('CHECKTIME', TRUE);

define('LOCALE', 'de');
define('DETAIL_LENGTH', 40);
define('likes_per_page', 5);


define('TEMPDIR', BASEPATH . DIRECTORY_SEPARATOR . 'workTemp');

define('STANDARD_TITLE', 'pageManager -- keep your Communitys in eyes');
define('STANDARD_DESCRIPTION', 'pagemanager, the social page manager');


/**
 * Datenbank Tabellen aliase
 */
define('TABLE_LIKE', '');
define('TABLE_USER_LIKE', '');
define('TABLE_USER', '');



//ZEND stuff
$ZENDDIR['LOCAL'] = ''; //$ZENDDIR['LOCAL'] . DIRECTORY_SEPARATOR
$ZENDDIR['SERVER'] = dirname(BASEPATH) . DIRECTORY_SEPARATOR . 'Zend' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR;
define('ZENDDIR', $ZENDDIR['SERVER']);

//set_include_path(get_include_path() . PATH_SEPARATOR . $ZENDDIR['SERVER'] . DIRECTORY_SEPARATOR);

//    define('PHPMAILER', BASEPATH. DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php');
?>
