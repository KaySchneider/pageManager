<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

define('PROJEKT_NAME', 'snipFrame');
define('BASEPATH', dirname(dirname(__FILE__)));
define('CSS_DIR',   'css' . DIRECTORY_SEPARATOR);
//facebook stuff
define('APP_API_KEY', '');
define('APP_SECRET', '');
define('APP_ID', '');
define('FACEBOOK_REG_PERMS', 'manage_pages');
//facebook stuff ends here


//setting development stufdf
define('CHECKTIME' , TRUE);

define('LOCALE', 'de');
define('DETAIL_LENGTH', 40);
define('likes_per_page',5);


define('TEMPDIR', BASEPATH . DIRECTORY_SEPARATOR . 'workTemp');

define('STANDARD_TITLE', 'snipframe');
define('STANDARD_DESCRIPTION', 'SNIPFRAME THE SOCIAL FRAMEWORK');


/**
 * Datenbank Tabellen aliase
 */
define('TABLE_LIKE', '');
define('TABLE_USER_LIKE', '');
define('TABLE_USER', '');

    
    define('DB_USER', '665c270781b3be');
    define('DB_HOST', 'localhost');
    define('DB_PASS', '36ddca2c');
    define('DB_BASE', 'heroku_ba4af5d9b0385be');
   
    //ZEND stuff
    $ZENDDIR['LOCAL'] = ''; //$ZENDDIR['LOCAL'] . DIRECTORY_SEPARATOR
    $ZENDDIR['SERVER'] = dirname(BASEPATH) . DIRECTORY_SEPARATOR . 'Zend' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR;
    define('ZENDDIR',$ZENDDIR['SERVER']);
 
    set_include_path( get_include_path() . PATH_SEPARATOR . $ZENDDIR['SERVER'] . DIRECTORY_SEPARATOR );
    
//    define('PHPMAILER', BASEPATH. DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'class.phpmailer.php');

?>