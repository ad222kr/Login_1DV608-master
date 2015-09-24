<?php

namespace model;

class LoginModel {
    /**
     * @var \common\ILoginStateHandler
     */
    private $loginStateHandler;
    private $DAL;

    public function __construct(\common\ILoginStateHandler $loginStateHandler, \model\dal\LoginModelDAL $DAL) {
        $this->loginStateHandler = $loginStateHandler;
        $this->DAL = $DAL;
    }

    public function authenticate(User $user) {
        // Currently encrypts the static variable self::\$password with SHA256 when
        // User logs in via cookies. Will fix another way if I have time but this will
        // have to do for the time being.
        $expectedUsername = $this->DAL->getUsername();
        $expectedPassword = $this->DAL->getHashedPassword();
        if (!$this->usernameIsVerified($user->getUsername(), $expectedUsername) ||
            !$this->passwordIsVerified($user->getPassword(), $expectedPassword))
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    public function authenticateUserWithCookies(User $user) {
        $expectedUsername = $this->DAL->getUsername();
        $expectedToken = $this->DAL->getToken();
        if(!$this->usernameIsVerified($user->getUsername(), $expectedUsername) ||
           !$this->tokenIsVerified($user->getPassword(), $expectedToken)) {
            throw new \WrongCredentialsException("Wrong cookie information");
        }
        $this->loginUser();
    }

    private function loginUser() {
        $this->loginStateHandler->setLoggedIn();
    }

    public function logoutUser() {
        $this->loginStateHandler->setLoggedOut();
    }

    public function userIsLoggedIn() {
        if ($this->loginStateHandler != null){
            return $this->loginStateHandler->getLoggedIn();
        }
        return false;
    }

    private function usernameIsVerified($enteredUsername, $dbUsername) {
        return $enteredUsername === $dbUsername;
    }

    private function passwordIsVerified($enteredPassword, $hashedPassword) {
        return password_verify($enteredPassword, $hashedPassword);
    }

    private function tokenIsVerified($tokenInCookie, $storedToken) {
        return $tokenInCookie === $storedToken;
    }

    public function getHashedPassword($toBeHashed) {
        return password_hash($toBeHashed, PASSWORD_BCRYPT);
    }

    public function generateToken() {
        // https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence#title.2
        // not good according to this article but will have to suffice for this assignment
        $token = '';
        for ($i = 0; $i < 30; $i++) {
            $token .= chr(mt_rand(0, 255));
        }
        $token = bin2hex($token);
        $this->DAL->saveToken($token);
        return $token;
    }
}