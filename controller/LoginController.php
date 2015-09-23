<?php

namespace controller;

class LoginController {

    private $loginModel;
    private $loginView;

    public function __construct(\model\LoginModel $loginModel, \view\LoginView $loginView) {
        $this->loginModel = $loginModel;
        $this->loginView = $loginView;
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {

        if (!$this->loginModel->userIsLoggedIn() && $this->loginView->didUserPressLogin()) {
            $this->login();
        } else if ($this->loginModel->userIsLoggedIn() && $this->loginView->didUserPressLogout()) {
            $this->logout();
        }

        return $this->loginModel->userIsLoggedIn();
    }

    private function login() {
        try {
            $user = $this->loginView->getUser();
            if ($user != null) {
                $this->loginModel->authenticateUser($user);
                if ($this->loginView->userWantsToBeRemembered()) {
                    $this->loginView->rememberUser();
                }
                $this->loginView->setLoginSucceeded();
            }
        }  catch (\WrongCredentialsException $e) {
            $this->loginView->setLoginFailed();
        }
    }

    private function logout() {
        $this->loginModel->logoutUser();
        $this->loginView->forgetUser();
        $this->loginView->setLogoutSucceeded();
    }

    public function getView() {
        return $this->loginView;
    }
}