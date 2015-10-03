<?php

namespace model;

class LoginModel {
    /**
     * @var \common\ILoginStateHandler
     */
    private $loginStateHandler;
    private $DAL;

    public function __construct(\common\ILoginStateHandler $loginStateHandler, \model\dal\UserDAL $DAL) {
        $this->loginStateHandler = $loginStateHandler;
        $this->DAL = $DAL;
    }

    public function authenticateWithPostCredentials(User $user) {

        if ($this->authenticatePostUser($user) === FALSE)
            throw new \WrongCredentialsException("Wrong name or password");

        $this->loginUser();
    }

    public function authenticateUserWithCookies(User $user) {
        $expectedUsername = $this->DAL->getUsername();
        $expectedPassword = $this->DAL->getUserCookies();
        if(!$this->usernameIsVerified($user->getUsername(), $expectedUsername) ||
           !$this->cookiePasswordIsVerified($user->getPassword(), $expectedPassword)) {
            throw new \WrongCredentialsException("Wrong cookie information");
        }
        $this->loginUser();
    }

    private function authenticatePostUser(User $user) {
        $users = $this->DAL->getUsersHashed();

        var_dump($users);

        foreach ($users as $registeredUser) {
            if ($user->getUsername() === $registeredUser->getUsername() &&
                $this->hashedPasswordIsVerified($user->getPassword(), $registeredUser->getPassword())){
                return true;
            }
        }
        return false;
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

    private function cookiePasswordIsVerified($cookiePassword, $storedCookiePassword) {
        return $cookiePassword === $storedCookiePassword;
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