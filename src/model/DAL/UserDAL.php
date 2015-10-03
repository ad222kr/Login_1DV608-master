<?php

namespace model\dal;

class UserDAL {

    private static $pathToHashedPasswords = "data/hasehd-passwords";
    private static $pathToCookiePasswords = "data/hashed-cookies";
    private static $username = "Admin"; // no need to keep this in a file tbh

    public function getUsers() {
        return scandir(self::$pathToHashedPassword);
    }

    public function getUsername() {
        return self::$username;
    }

    public function saveCookiePassword($username, $cookiePassword) {
        file_put_contents(self::$pathToCookiePassword, $cookiePassword);
    }

    public function getCookiePassword() {
        return file_get_contents(self::$pathToCookiePassword);
    }

}