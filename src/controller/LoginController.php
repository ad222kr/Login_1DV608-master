<?php

namespace controller;

use common\UserNotRegisteredException;

class LoginController {

    /**
     * @var \model\LoginModel
     */
    private $loginModel;

    /**
     * @var \view\LoginView
     */
    private $loginView;

    public function __construct(\model\LoginModel $loginModel, \view\LoginView $loginView) {
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {

        if (!$this->loginModel->userIsLoggedIn() && $this->loginView->userWantsToLogin()) {
            $this->login();

        } else if ($this->loginModel->userIsLoggedIn() && $this->loginView->userWantsToLogout()) {
            $this->logout();
        }

        return $this->loginModel->userIsLoggedIn();
    }

    private function login() {
        try {
            $user = $this->loginView->getUser();
            if ($user == null) return;

            $this->loginModel->tryLoginUser($user);
            $this->loginView->setLoginSucceeded();
            $this->loginView->reloadPage();

        }  catch (\WrongCredentialsException $e) {
            $this->loginView->setLoginFailed();
        }
    }

    private function logout() {
        $this->loginModel->logoutUser();
        $this->loginView->forgetUser();
        $this->loginView->setLogoutSucceeded();
        $this->loginView->reloadPage();
    }

    public function getView() {
        return $this->loginView;
    }
}