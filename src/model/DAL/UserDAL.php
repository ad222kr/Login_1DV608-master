<?php

namespace model\dal;

require_once("src/common/UserNotRegisteredException.php");

class UserDAL {

    private static $pathToHashedCredentials = "data/user-hashed-password";

    public function getUserByName($username) {
        //TODO: better names
        $scanned_dir = array_diff(scandir(self::$pathToHashedCredentials), array("..", "."));

        foreach ($scanned_dir as $registeredName) { // file-handle is the username
            if ($username === $registeredName) {
                $password = file_get_contents(self::$pathToHashedCredentials . "/" . $username);
                return new \model\User($username, $password, ""); // temp-pw empty here, maybe have same DAL for everything?
            }
        }
        throw new \WrongCredentialsException("Could not find user in the database");
    }

    public function saveUserCredentials(User $user) {
        file_put_contents(self::$pathToHashedCredentials . "/" . $user->getUsername(), password_hash($user->getPassword()));
    }

}