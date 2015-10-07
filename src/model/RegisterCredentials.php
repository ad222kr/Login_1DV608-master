<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-07
 * Time: 19:21
 */

namespace model;

// Baseclass for this and user-creds probably

require_once("src/common/UsernameToShortException.php");
require_once("src/common/PasswordToShortException.php");
require_once("src/common/PasswordDoNotMatchException.php");


class RegisterCredentials extends UserCredentials {

    private static $minUsernameLength = 3;
    private static $minPasswordLength = 6;

    private $username;
    private $password;

    public function __construct($username, $password, $repeatPassword) {

        if (trim($username) == "" && trim($password) == "") {
            throw new \common\RegistrationCredentialsMissingException("Credentials missing");
        }

        if (trim(strlen($username)) < self::$minUsernameLength)
            throw new \common\UsernameToShortException("Username to short");
        if (trim(strlen($password)) < self::$minPasswordLength)
            throw new \common\PasswordToShortException("Password to short");
        if ($password !== $repeatPassword)
            throw new \common\PasswordDoNotMatchException("Passwords do not match");

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