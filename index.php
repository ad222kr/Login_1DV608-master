<?php

require_once('src/controller/MasterController.php');
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


//TODO: MOVE BACK TO MASTER CONTROLLER
//TODO: check why testcase 1.8 doesnt work now?? in automated tests.....



$app = new \controller\MasterController();
$app->run();

