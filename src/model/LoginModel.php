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

    public function authenticateWithPostCredentials(User $user) {
        $expectedUsername = $this->DAL->getUsername();
        $expectedPassword = $this->DAL->getHashedPassword();
        if (!$this->usernameIsVerified($user->getUsername(), $expectedUsername) ||
            !$this->hashedPasswordIsVerified($user->getPassword(), $expectedPassword))
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    public function authenticateUserWithCookies(User $user) {
        $expectedUsername = $this->DAL->getUsername();
        $expectedPassword = $this->DAL->getCookiePassword();
        if(!$this->usernameIsVerified($user->getUsername(), $expectedUsername) ||
           !$this->cookiePasswordIsVerified($user->getPassword(), $expectedPassword)) {
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

    private function hashedPasswordIsVerified($enteredPassword, $hashedPassword) {
        return password_verify($enteredPassword, $hashedPassword);
    }

    private function cookiePasswordIsVerified($tokenInCookie, $storedToken) {
        return $tokenInCookie === $storedToken;
    }

    public function generateCookiePassword() {
        // https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence#title.2
        // not good according to this article but will have to suffice for this assignment
        $password = '';
        for ($i = 0; $i < 30; $i++) {
            $password .= chr(mt_rand(0, 255));
        }
        $password = bin2hex($password);
        $this->DAL->saveCookiePassword($password);
        return $password;
    }
}