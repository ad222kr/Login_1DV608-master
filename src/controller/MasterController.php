<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:52
 */

namespace controller;
require_once('src/common/ILoginStateHandler.php');
require_once('src/common/ITempDataHandler.php');

require_once('src/view/BaseView.php');
require_once('src/view/LoginView.php');
require_once('src/view/DateTimeView.php');
require_once('src/view/LayoutView.php');
require_once('src/view/NavigationView.php');
require_once('src/view/RegisterView.php');

require_once('src/model/UserCredentials.php');
require_once('src/model/RegisterCredentials.php');
require_once('src/model/LoginModel.php');
require_once('src/model/RegisterModel.php');

require_once('src/common/SessionHandler.php');
require_once('src/view/CookieHandler.php');

require_once('src/controller/LoginController.php');
require_once('src/controller/RegisterController.php');
require_once('src/model/DAL/UserDAL.php');
require_once('src/model/DAL/TempCredentialsDAL.php');

require_once('src/common/PasswordMissingException.php');
require_once('src/common/PasswordDoNotMatchException.php');
require_once('src/common/PasswordToShortException.php');
require_once('src/common/UsernameMissingException.php');
require_once('src/common/UsernameToShortException.php');
require_once('src/common/UsernameTakenException.php');
require_once('src/common/WrongCredentialsException.php');
require_once('src/common/RegistrationCredentialsMissingException.php');
require_once('src/common/NotAllowedCharactersInUsernameException.php');


class MasterController {

    /**
     * @var \model\dal\UserDAL
     */
    private $userDAL;


    public function __construct() {
        $this->userDAL = new \model\dal\UserDAL();
    }

    public function run() {

        $dateTimeView = new \view\DateTimeView();
        $layoutView = new \view\LayoutView();
        $navigationView = new \view\NavigationView();
        $sessionHandler = new \common\SessionHandler();
        $isLoggedIn = false;

        if ($navigationView->userWantsToRegister()) {
            $registerModel = new \model\RegisterModel($this->userDAL);
            $registerView = new \view\RegisterView($sessionHandler, $registerModel);
            $registerController = new \controller\RegisterController($registerModel, $registerView);

            $registerController->doRegisterAction();
            $html = $registerController->getView()->response();
        } else {
            $cookieHandler = new \view\CookieHandler();
            $loginModel = new \model\LoginModel($sessionHandler, $this->userDAL);
            $loginView = new \view\LoginView($sessionHandler, $cookieHandler, $loginModel);
            $loginController = new \controller\LoginController($loginModel, $loginView);

            $isLoggedIn = $loginController->doLoginAction();
            $html = $loginController->getView()->response();
        }

        $layoutView->render($isLoggedIn, $html, $dateTimeView, $navigationView);
    }
}