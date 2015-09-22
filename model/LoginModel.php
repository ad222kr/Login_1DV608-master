<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-16
 * Time: 15:45
 */

namespace model;


class LoginModel {
    private static $username = "Admin";
    private static $password = "Password";

    private $sessionHandler;

    public function __construct(\common\SessionHandler $sessionHandler) {
        $this->sessionHandler = $sessionHandler;
    }

    public function authenticateUser(User $user) {
        if ($user->getUsername() !== self::$username || $user->getPassword() !== self::$password)
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    private function loginUser() {
        $this->sessionHandler->setLoggedIn();
    }

    public function logoutUser() {
        $this->sessionHandler->unsetLoggedIn();
    }

    public function userIsLoggedIn() {
        if ($this->sessionHandler != null)
            return $this->sessionHandler->getLoggedIn();
    }

    private function encryptPassword($password) {
        
    }
}