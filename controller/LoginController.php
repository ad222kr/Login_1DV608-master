<?php

namespace controller;


class LoginController {

    private $user = null;
    private $loginView;
    public function __construct(\model\User $user) {
        $this->user = $user;
        $this->loginView = new \view\LoginView($this->user);
    }

    public function login() {
        if ($this->isAuthenticated()) {
            return true;
        }
        return false;
    }

    public function logout() {
    }

    public function getHTML($isLoggedIn) {
        return $this->loginView->response($isLoggedIn);
    }

    private function isAuthenticated() {
        return $this->user->getUsername() === $this->loginView->getRequestUserName() &&
               $this->user->getPassword() === $this->loginView->getRequestPassword();
    }
}