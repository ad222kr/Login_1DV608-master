<?php

namespace controller;


class LoginController {

    private $user = null;
    private $loginModel;
    private $loginView;
    public function __construct(\model\LoginModel $loginModel) {
        $this->loginModel = $loginModel;
        $this->loginView = new \view\LoginView();
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {
        $username = $this->loginView->getRequestUserName();
        $password = $this->loginView->getRequestPassword();


        $this->user = new \model\User($username, $password);


        if ($this->loginView->userWantsToLogin()){
            $this->loginModel->authenticateUser($this->user);
        } elseif ($this->loginView->userWantsToLogout()) {
            $this->loginModel->logoutUser();
        }




        return $this->user->isLoggedIn();
    }

    public function renderView() {
        return $this->loginView->response($this->user->isLoggedIn());
    }
}