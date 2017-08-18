<?php

//Format: dd-mm-yyyy
// $string = '21-11-2015';

//Year 2015, month 11, day 21

// $pattern = '/([0-9]{2})-([0-9]{2})-([0-9]{4})/';
// $replacement = 'Year $3, month $2, day $1';

// echo preg_replace($pattern, $replacement, $string);


//FRONT CONTROLLER

//1. Common settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

//2. Connecting system files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
// require_once(ROOT.'/components/Router.php');
// require_once(ROOT.'/components/Db.php');

//3. Establishing a connection to the database

//4. Calling Router
$router = new Router();
$router->run();
// echo __FILE__;