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
    private static $isLoggedInName = "isLoggedIn";

    private $sessionModel;

    public function __construct(SessionModel $sessionModel) {
        $this->sessionModel = $sessionModel;
    }

    public function authenticateUser(User $user) {
        if ($user->getUsername() !== self::$username || $user->getPassword() !== self::$password)
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    private function loginUser() {
        $this->sessionModel->setSessionData(self::$isLoggedInName, true);
    }

    public function logoutUser() {
        $this->sessionModel->unsetSessionData(self::$isLoggedInName);
    }

    public function userIsLoggedIn() {
        return $this->sessionModel->getSessionData(self::$isLoggedInName);
    }
}