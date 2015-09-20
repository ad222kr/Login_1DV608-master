<?php

namespace model;

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        if (trim($username) == '')
            throw new \Exception("Username is missing");
        if (strlen($password) == 0)
            throw new \Exception("Password is missing");
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