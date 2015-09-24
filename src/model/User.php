<?php

namespace model;

class User {
    private $username;
    private $password; // holds the token aswell for now
    private $token;

    public function __construct($username, $password, $token = "") {
        assert(is_string($username), "Username needs to be of type string");
        assert(is_string($password), "Password needs to be of type string");
        assert(is_string($token), "Token needs to be of type string");
        if (trim($username) == '')
            throw new \UsernameMissingException("Username is missing");
        if (trim($password) == '')
            throw new \PasswordMissingException("Password is missing");
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }






}