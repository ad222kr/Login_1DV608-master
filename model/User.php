<?php

namespace model;

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        if (trim($username) == '')
            throw new \UsernameMissingException("Username is missing");
        if (trim($password) == '')
            throw new \PasswordMissingException("Password is missing");
        $this->username = $username;
        $this->password = $password;

        $this->isLoggedIn = false;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }





}