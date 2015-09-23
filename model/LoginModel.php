<?php

namespace model;

class LoginModel {
    private static $username = "Admin";
    private static $password = "Password";

    private $isPersistentLogin;
    private $loginStateHandler;

    public function __construct(\common\ILoginStateHandler $loginStateHandler) {
        $this->loginStateHandler = $loginStateHandler;
    }

    public function authenticateUser(User $user) {
        if ($user->getUsername() !== self::$username || $user->getPassword() !== self::$password)
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    private function loginUser() {
        $this->loginStateHandler->setLoggedIn();
    }

    public function logoutUser() {
        $this->loginStateHandler->setLoggedOut();
    }

    public function userIsLoggedIn() {
        if ($this->loginStateHandler != null)
            return $this->loginStateHandler->getLoggedIn();
    }

    public function encryptPassword($password) {
        return hash("sha256", $password);
    }
}