<?php

namespace model\dal;

class LoginModelDAL {


    private static $pathToHashedPassword = "data/hashedpw";
    private static $pathToCookiePassword = "data/cookiepw";
    private static $username = "Admin"; // no need to keep this in a file tbh

    public function getHashedPassword() {
        return file_get_contents(self::$pathToHashedPassword);
    }

    public function getUsername() {
        return self::$username;
    }

    public function saveToken($cookiePassword) {
        file_put_contents(self::$pathToCookiePassword, $cookiePassword);
    }

    public function getToken() {
        return file_get_contents(self::$pathToCookiePassword);
    }

}