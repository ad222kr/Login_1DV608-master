<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:52
 */

namespace controller;

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





class MasterController {

    private $sessionHandler;
    private $cookieHandler;
    private $userDAL;

    public function __construct() {
        $this->sessionHandler= new \common\SessionHandler();
        $this->cookieHandler = new \view\CookieHandler();
        $this->userDAL = new \model\dal\UserDAL();
    }


    public function run() {
        //CREATE OBJECTS OF THE MODELS

        $dateTimeView = new \view\DateTimeView();
        $layoutView = new \view\LayoutView();
        $navigationView = new \view\NagivationView();
        $isLoggedIn = false;

        if ($navigationView->userWantsToRegister()) {

            $registerModel = new \model\RegisterModel($this->userDAL);
            $registerView = new \view\RegisterView($this->sessionHandler, $registerModel);
            $registerController = new \controller\RegisterController($registerModel, $registerView);

            $registerController->doRegisterAction();
            $html = $registerController->getView()->response();
        } else {

            $loginModel = new \model\LoginModel($this->sessionHandler, $this->userDAL);
            $loginView = new \view\LoginView($this->sessionHandler, $this->cookieHandler, $loginModel);
            $loginController = new \controller\LoginController($loginModel, $loginView);

            $isLoggedIn = $loginController->doLoginAction();
            $html = $loginController->getView()->response();

        }

        $layoutView->render($isLoggedIn, $html, $dateTimeView, $navigationView);
    }
}