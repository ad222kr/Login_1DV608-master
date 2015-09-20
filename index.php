<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');

require_once('model/User.php');
require_once('model/LoginModel.php');
require_once('model/SessionModel.php');

require_once('controller/LoginController.php');

require_once('common/PasswordMissingException.php');
require_once('common/UsernameMissingException.php');
require_once('common/WrongCredentialsException.php');


//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE OBJECTS OF THE MODELS
$sessionModel = new \model\SessionModel();
$loginModel = new \model\LoginModel($sessionModel);

//CREATE OBJECTS OF THE VIEWS
$dateTimeView = new view\DateTimeView();
$layoutView = new view\LayoutView();
$loginView = new view\LoginView($sessionModel);

//CREATE OBJECTS OF THE CONTROLLERS
$loginController = new \controller\LoginController($loginModel, $sessionModel, $loginView);


$isLoggedIn = $loginController->doLoginAction();
$loginView = $loginController->getView();


$layoutView->render($isLoggedIn, $loginView, $dateTimeView);

