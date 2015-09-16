<?php

namespace model;

class User {
    private $username;
    private $password;
    private $isLoggedIn;

    public function __construct($username, $password) {
        if ($username = "")
            throw new \Exception("Username is missing");
        if ($password = "")
            throw new \Exception("Password is missing");
        $this->username = $username;
        $this->password = $password;
        var_dump($this->username);
        var_dump($this->password);
        $this->isLoggedIn = false;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setIsLoggedIn($status) {
        $this->isLoggedIn = $status;
    }

    public function isLoggedIn() {
        return $this->isLoggedIn;
    }



}