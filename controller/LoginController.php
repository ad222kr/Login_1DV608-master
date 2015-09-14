<?php

namespace controller;


class LoginController {

    private static $isLoggedInName = "isLoggedIn";

    private $user = null;
    private $loginView;
    public function __construct(\model\User $user) {
        $this->user = $user;
        $this->loginView = new \view\LoginView($this->user);
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {
        if ($this->loginView->isLogout()){
            $this->logout();
            session_
        } else {
            session_start();
            $this->login();
        }
        return $this->isLoggedIn();
    }

    private function login() {
        if ($this->isAuthenticated()) {
            $this->setIsLoggedIn(true);
        }
    }

    private function logout() {
        if ($this->isLoggedIn()){
            $this->setIsLoggedIn(false);
        }
    }

    public function getHTML() {
        return $this->loginView->response($_SESSION[self::$isLoggedInName]);
    }

    private function isLoggedIn() {
        if (isset($_SESSION[self::$isLoggedInName])){
            return $_SESSION[self::$isLoggedInName];
        }
    }

    private function setIsLoggedIn($value) {
        $_SESSION[self::$isLoggedInName] = $value;
    }

    private function isAuthenticated() {
        return $this->user->getUsername() === $this->loginView->getRequestUserName() &&
               $this->user->getPassword() === $this->loginView->getRequestPassword();
    }
}