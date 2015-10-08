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
        if ($this->DAL->usernameExists($credentials->getUsername())){
            throw new \common\UsernameTakenException("Username taken");
        }

        $this->saveUser($credentials);

    }

    private function saveUser(UserCredentials $credentials) {
        $this->DAL->saveUserCredentials($credentials->getUsername(), $credentials->getPassword());
    }




}