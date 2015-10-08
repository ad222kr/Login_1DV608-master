<?php

namespace model\dal;

class UserDAL {

    private static $pathToHashedCredentials = "data/user-hashed-password";

    public function getUserByName($username) {
        $scanned_dir = array_diff(scandir(self::$pathToHashedCredentials), array("..", "."));

        foreach ($scanned_dir as $registeredName) { // file-handle is the username
            if ($username === $registeredName) {
                $password = file_get_contents(self::$pathToHashedCredentials . "/" . $username);
                return new \model\UserCredentials($username, $password); // temp-pw empty here, maybe have same DAL for everything?
            }
        }
        throw new \WrongCredentialsException("Could not find user in the database");
    }

    public function saveUserCredentials($username, $password) {
        file_put_contents(self::$pathToHashedCredentials . "/" . $username, password_hash($password, CRYPT_BLOWFISH));
    }

}