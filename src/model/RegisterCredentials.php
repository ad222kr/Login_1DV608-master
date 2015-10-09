<?php

namespace model;

class RegisterCredentials extends UserCredentials {

    private static $minUsernameLength = 3;
    private static $minPasswordLength = 6;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param $username
     * @param $password
     * @param string $repeatPassword
     * @throws \common\NotAllowedCharactersInUsernameException
     * @throws \common\PasswordDoNotMatchException
     * @throws \common\PasswordToShortException
     * @throws \common\RegistrationCredentialsMissingException
     * @throws \common\UsernameToShortException
     */
    public function __construct($username, $password, $repeatPassword) {

        if ($username != strip_tags($username))
            throw new \common\NotAllowedCharactersInUsernameException("Not allowd chars in username");
        if (trim($username) == "" && trim($password) == "")
            throw new \common\RegistrationCredentialsMissingException("Credentials missing");
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