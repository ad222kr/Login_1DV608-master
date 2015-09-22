<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/User.php');
require_once('model/LoginModel.php');
require_once('common/SessionHandler.php');
require_once('common/CookieHandler.php');

require_once('controller/LoginController.php');

require_once('common/PasswordMissingException.php');
require_once('common/UsernameMissingException.php');
require_once('common/WrongCredentialsException.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set("Europe/Stockholm");





//CREATE OBJECTS OF THE MODELS
$sessionHandler = new \common\SessionHandler();
$cookieHandler = new common\CookieHandler();
$loginModel = new \model\LoginModel($sessionHandler);;

//CREATE OBJECTS OF THE VIEWS
$dateTimeView = new view\DateTimeView();
$layoutView = new view\LayoutView();
$loginView = new view\LoginView($sessionHandler, $cookieHandler, $loginModel);

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($loginModel, $loginView);


$isLoggedIn = $loginController->doLoginAction();
$loginView = $loginController->getView();


$layoutView->render($isLoggedIn, $loginView, $dateTimeView);

