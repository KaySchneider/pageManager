<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 *
 * 
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

include("config/config.php");

include 'classes/autoloader.php';

include("config/migrateHelper.php");
//init time checker
if (CHECKTIME == TRUE) {
    $timer = new stopTime();
}
$reg = registry::getInstance();
//setting here the basecss files
//TODO: put this in an seperate file, wicht the user can do itself things
$reg->setCSSFiles('fbstyles.css');
$reg->setCSSFiles('detailFB.css');
$reg->setCSSFiles('startFB.css');

$reg->setJSFiles('jquery-1.6.min.js');
$reg->setJSFiles('snipFrame.js');
$reg->setJSFiles('facebookHelper.js');
//base css files end here TODO: set this in the config
/**
 * Hier rendern der Start und End View
 */
/* if(!$_GET['maintanance'])
  die('Entschuldigung wir sind Offline wegen Wartungsarbeiten'); */

$resolver = new FileSystemCommandResolver('controller', 'startPage');
$controller = new FrontController($resolver);

/**
 * Füge den Event Dispatcher hinzu!!
 * onException => Neues Event einfach in die Datenbank schreiben!
 */
$eventDispatcher = eventDispatcher::getInstance();
$exceptionLogger = new exceptionLogger();
//$eventDispatcher->addHandler('onFBUserNoRights', $fbUserGetRights);
$eventDispatcher->addHandler('onException', $exceptionLogger);


$request = new HttpRequest();
//change the response object if we are in an json call
if ($request->issetParameter('json')) {
    $response = new jsonResponse();
} else {
    $response = new HttpResponse();
}
/**
 * Add Filter to the controller
 * Post and Pre Filter
 * the first Filter is the DoPage Filter
 * it renders an HTML VIEW!
 */

$cookie = $request->getCookies();
$layoutFilter = new layoutFilterFB();
$controller->addPreFilter($layoutFilter);

$postLayoutFilter = new postLayoutFilter();
$controller->addPostFilter($postLayoutFilter);


$controller->handleRequest($request, $response);
if (CHECKTIME == TRUE) {
    print "time execute:" . $timer->GetTime();
}
?>
