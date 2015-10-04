<?php

namespace model;

require_once('src/common/PasswordMissingException.php');
require_once('src/common/UsernameMissingException.php');
require_once('src/common/WrongCredentialsException.php');

class User {
    private $username;
    private $password;
    private $isCookiePassword;

    public function __construct($username, $password, $isCookiePassword = false) {
        assert(is_string($username), "Username needs to be of type string");
        assert(is_string($password), "Password needs to be of type string");

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

    public function isCookiePassword() {
        return $this->isCookiePassword;
    }
}