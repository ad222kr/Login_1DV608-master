<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:37
 */

namespace model;




class RegisterModel {

    private $DAL;

    public function __construct(\model\dal\UserDAL $DAL) {
        $this->DAL = $DAL;
    }

    public function registerUser(RegisterCredentials $credentials) {
        if ($this->isUsernameTaken($credentials->getUsername()))
            throw new \common\UsernameTakenException("Username taken");

        $this->saveUser($credentials);

    }

    private function saveUser(UserCredentials $credentials) {
        $this->DAL->saveUserCredentials($credentials->getUsername(), $credentials->getPassword());
    }

    private function isUsernameTaken($username) {
        try {
            $registeredUsername = $this->DAL->getUserByName($username)->getUsername();
            return true;
        } catch (\WrongCredentialsException $e) {
            // if WrongCredentialsException is thrown from DAL the username is not taken
            // maybe fix better solution?
            return false;
        } catch (\PasswordMissingException $e) {
            // when username is not taken this exception is thrown from UserCredentials.
            // TODO: Fix better
            return false;
        }
    }

}