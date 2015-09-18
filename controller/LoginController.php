<?php

namespace controller;


use model\User;

class LoginController {

    private $user = null;
    private $loginModel;
    private $loginView;
    public function __construct(\model\LoginModel $loginModel) {
        $this->loginModel = $loginModel;
        $this->loginView = new \view\LoginView($this->loginModel);
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {

        if ($this->loginView->userWantsToLogin()) {
            try {
                $this->createUser();
                $this->loginModel->authenticateUser($this->user);
            } catch (\Exception $e) {
                $this->loginView->setMessage($e->getMessage());
            }
        } else if ($this->loginView->userWantsToLogout()) {
            $this->loginModel->logoutUser();
        }
        return $this->loginModel->userIsLoggedIn();

    }

    public function getView() {
        return $this->loginView;
    }

    public function createUser() {
        $username = $this->loginView->getRequestUserName();
        $password = $this->loginView->getRequestPassword();


        $this->user = new \model\User($username, $password);
    }
}