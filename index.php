<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE MODELS
$user = new \model\User();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($user);
$dtv = new DateTimeView();
$lv = new LayoutView();

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($v, $user);

//Authenticate

$isLoggedIn = $loginController->login();
$html = $loginController->getHTML();

var_dump($isLoggedIn);


$lv->render($isLoggedIn, $html, $dtv);

