<?php

require_once('src\controller\MasterController.php');
require_once('src/common/ILoginStateHandler.php');
require_once('src/common/ITempMessageHandler.php');

require_once('src/view/LoginView.php');
require_once('src/view/DateTimeView.php');
require_once('src/view/LayoutView.php');
require_once('src/view/NagivationView.php');
require_once('src/view/RegisterView.php');

require_once('src/model/User.php');
require_once('src/model/LoginModel.php');
require_once('src/model/RegisterModel.php');

require_once('src/common/SessionHandler.php');
require_once('src/view/CookieHandler.php');

require_once('src/controller/LoginController.php');
require_once('src/controller/RegisterController.php');
require_once('src/model/DAL/UserDAL.php');
require_once('src/model/DAL/TempCredentialsDAL.php');

require_once('src/common/PasswordMissingException.php');
require_once('src/common/UsernameMissingException.php');
require_once('src/common/WrongCredentialsException.php');
require_once('src/common/UserNotRegisteredException.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set("Europe/Stockholm");



$sessionHandler= new \common\SessionHandler();
$cookieHandler = new \view\CookieHandler();
$userDAL = new \model\dal\UserDAL();

$dateTimeView = new \view\DateTimeView();
$layoutView = new \view\LayoutView();
$navigationView = new \view\NagivationView();

if ($navigationView->userWantsToRegister()) {

    $registerModel = new \model\RegisterModel($userDAL);
    $registerView = new \view\RegisterView($sessionHandler, $registerModel);
    $registerController = new \controller\RegisterController($registerModel, $registerView);

    $registerController->doRegisterAction();
    $html = $registerController->getView()->response();
} else {

    $loginModel = new \model\LoginModel($sessionHandler, $userDAL);
    $loginView = new \view\LoginView($sessionHandler, $cookieHandler, $loginModel);
    $loginController = new \controller\LoginController($loginModel, $loginView);

    $isLoggedIn = $loginController->doLoginAction();
    $html = $loginController->getView()->response();

}

$layoutView->render($isLoggedIn, $html, $dateTimeView, $navigationView);

//$app = new \controller\MasterController();
//$app->run();

