<?php

require_once("src/controller/MasterController.php");




//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
date_default_timezone_set("Europe/Stockholm");


//TODO: MOVE BACK TO MASTER CONTROLLER
//TODO: check why testcase 1.8 doesnt work now?? in automated tests.....



$app = new \controller\MasterController();
$app->run();

