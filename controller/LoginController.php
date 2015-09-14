<?php

namespace controller;


class LoginController {

    private $user = null;
    private $loginView;

    public function __construct(\LoginView $loginView, \model\User $user) {
        $this->loginView = $loginView;
        $this->user = $user;
    }

    public function login() {
        if ($this->isAuthenticated()) {
            return true;
        }
        return false;
    }

    public function logout() {
        $this->user->setLoggedIn(false);
    }

    public function getHTML() {
        return $this->loginView->response();
    }

    private function isAuthenticated() {
        return $this->user->getUsername() === $this->loginView->getRequestUserName() &&
               $this->user->getPassword() === $this->loginView->getRequestPassword();
    }
}