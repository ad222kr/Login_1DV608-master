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

    public function authenticateUser(\model\User $user) {
        if ($user->getUsername() !== self::$username || $user->getPassword() !== self::$password)
            throw new \Exception("Username or password is wrong!");

        $this->loginUser();
    }

    private function loginUser() {
        $_SESSION[self::$isLoggedInName] = true;
    }

    public function logoutUser() {
        if (isset($_SESSION[self::$isLoggedInName])) {
            unset($_SESSION[self::$isLoggedInName]);
        }
    }

    private function isUserLoggedIn() {
        if (isset($_SESSION[self::$isLoggedInName])) {
            return $_SESSION[self::$isLoggedInName];
        }
    }
}