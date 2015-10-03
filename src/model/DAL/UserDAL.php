<?php

namespace model\dal;

class UserDAL {

    private static $pathToHashedCredentials = "data/user-hashed-password";
    private static $pathToCookieCredentials = "data/user-cookies";
    private static $username = "Admin"; // no need to keep this in a file tbh

    /**
     * @return array
     */
    public function getUsersHashed() {
        //TODO: better names
        $scanned_dir = array_diff(scandir(self::$pathToHashedCredentials), array("..", "."));
        $users = array();

        foreach ($scanned_dir as $user) {
            $username = $user;
            $password = file_get_contents(self::$pathToHashedCredentials . "/" .$user);
            $userCredentials = new \model\User($username, $password);
            $users[] = $userCredentials;
        }
        return $users;
    }

    public function getUsersCookies() {
        $scanned_dir = array_diff(scandir(self::$pathToCookieCredentials), array("..", "."));
        $users = array();

        foreach ($scanned_dir as $user) {
            $username = $user;
            $password = file_get_contents(self::$pathToCookieCredentials . "/" .$user);
            $userCredentials = new \model\User($username, $password);
            $users[] = $userCredentials;
        }
        return $user;
    }

    public function saveHashedPassword($username, $hashedPassword) {
        file_put_contents(self::$pathToHashedCredentials . "/" . $username, $hashedPassword);
    }

    public function saveCookiePassword($username, $cookiePassword) {
        file_put_contents(self::$pathToCookiePassword . "/" . $username, $cookiePassword);
    }

    public function getUserCookies() {
        return file_get_contents(self::$pathToCookiePassword);
    }

}