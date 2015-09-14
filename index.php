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

//Start session
session_start();

//CREATE OBJECTS OF THE MODELS
$user = new \model\User();

//CREATE OBJECTS OF THE VIEWS

$dtv = new view\DateTimeView();
$lv = new view\LayoutView();

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($user);


$isLoggedIn = $loginController->doLoginAction();
$html = $loginController->getHTML();

$lv->render($isLoggedIn, $html, $dtv);

