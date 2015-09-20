<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('model/User.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/SessionModel.php');
require_once('common/PasswordMissingException.php');
require_once('common/UsernameMissingException.php');
require_once('common/WrongCredentialsException.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Start session
session_start();

//CREATE OBJECTS OF THE MODELS
$sessionModel = new \model\SessionModel();
$loginModel = new \model\LoginModel($sessionModel);

//CREATE OBJECTS OF THE VIEWS

$dtv = new view\DateTimeView();
$lv = new view\LayoutView();

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($loginModel, $sessionModel);


$isLoggedIn = $loginController->doLoginAction();
$loginView = $loginController->getView();


$lv->render($isLoggedIn, $loginView, $dtv);

