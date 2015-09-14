<?php

namespace model;

class User {

    private $username = "Admin";
    private $password = "Password";

    public function __construct() {
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }



}