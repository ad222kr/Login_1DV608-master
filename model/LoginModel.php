<?php

namespace model;

class LoginModel {
    private static $username = "Admin";
    private static $password = "Password";

    /**
     * @var \common\ILoginStateHandler
     */
    private $loginStateHandler;

    public function __construct(\common\ILoginStateHandler $loginStateHandler) {
        $this->loginStateHandler = $loginStateHandler;
    }

    public function authenticateUser(User $user, $userIsRemembered) {
        // Currently encrypts the static variable self::\$password with SHA256 when
        // User logs in via cookies. Will fix another way if I have time but this will
        // have to do for the time being.
        $password = $userIsRemembered ? $this->encryptPassword(self::$password) : self::$password;
        if ($user->getUsername() !== self::$username || $user->getPassword() !== $password)
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
        if ($this->loginStateHandler != null){
            return $this->loginStateHandler->getLoggedIn();
        }
        return false;

    }

    public function encryptPassword($password) {
        return hash("sha256", $password);
    }
}