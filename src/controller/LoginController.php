<?php

namespace controller;

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

        if (!$this->loginModel->userIsLoggedIn() &&
            ($this->loginView->didUserPressLogin() || $this->loginView->userCredentialCookieExists())) {
            $this->login($this->loginView->userCredentialCookieExists());
        } else if ($this->loginModel->userIsLoggedIn() && $this->loginView->didUserPressLogout()) {
            $this->logout();
        }

        return $this->loginModel->userIsLoggedIn();
    }

    private function login($isCookieLogin) {
        try {
            $user = $this->loginView->getUser();
            if ($user == null) return;
            if ($isCookieLogin) {
                $this->loginModel->authenticateUserWithCookies($user);
            } else {
                $this->loginModel->authenticateWithPostCredentials($user);
            }
            $this->loginView->setLoginSucceeded();
        }  catch (\WrongCredentialsException $e) {
            $this->loginView->setLoginFailed($isCookieLogin);
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