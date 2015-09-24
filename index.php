<?php

//INCLUDE THE FILES NEEDED...
require_once('src/common/ILoginStateHandler.php');
require_once('src/common/ITempMessageHandler.php');

require_once('src/view/LoginView.php');
require_once('src/view/DateTimeView.php');
require_once('src/view/LayoutView.php');

require_once('src/model/User.php');
require_once('src/model/LoginModel.php');

require_once('src/common/SessionHandler.php');
require_once('src/view/CookieHandler.php');

require_once('src/controller/LoginController.php');
require_once('src/model/DAL/LoginModelDAL.php');

require_once('src/common/PasswordMissingException.php');
require_once('src/common/UsernameMissingException.php');
require_once('src/common/WrongCredentialsException.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set("Europe/Stockholm");

//CREATE OBJECTS OF THE MODELS
$sessionHandler= new \common\SessionHandler();
$cookieHandler = new \view\CookieHandler();
$loginModelDAL = new \model\dal\LoginModelDAL();
$loginModel = new \model\LoginModel($sessionHandler, $loginModelDAL);

//CREATE OBJECTS OF THE VIEWS
$dateTimeView = new view\DateTimeView();
$layoutView = new view\LayoutView();
$loginView = new view\LoginView($sessionHandler, $cookieHandler, $loginModel);

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($loginModel, $loginView);


$isLoggedIn = $loginController->doLoginAction();
$loginView = $loginController->getView();


$layoutView->render($isLoggedIn, $loginView, $dateTimeView);

