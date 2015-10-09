<?php

namespace model\dal;

class UserDAL {

    private static $pathToHashedCredentials = "data/user-hashed-password";

    /**
     * @param $username
     * @return \model\UserCredentials
     * @throws \WrongCredentialsException
     */
    public function getUserByName($username) {

        $scannedDirectory = array_diff(scandir(self::$pathToHashedCredentials), array("..", "."));
        foreach ($scannedDirectory as $registeredName) { // file-handle is the username
            if ($username === $registeredName) {
                $password = file_get_contents(self::$pathToHashedCredentials . "/" . $username);
                return new \model\UserCredentials($username, $password); // temp-pw empty here, maybe have same DAL for everything?
            }
        }
        throw new \WrongCredentialsException("Could not find user in the database");
    }


    /**
     * @param $username
     * @return bool if the username is taken
     */
    public function usernameExists($username) {

        $scannedDirectory = array_diff(scandir(self::$pathToHashedCredentials), array("..", "."));
        foreach ($scannedDirectory as $registeredName) {
            if ($username === $registeredName){
                return true;
            }
        }
        return false;
    }

    public function saveUserCredentials($username, $password) {
        try{
            file_put_contents(self::$pathToHashedCredentials . "/" . $username, password_hash($password, CRYPT_BLOWFISH));
        } catch (\Exception $e) {
            // logging or smth
            throw $e;
        }
    }

}