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

        $users = $this->DAL->getUsersHashed();


        foreach ($users as $registeredUser) {
            if (!$user->getUsername() === $registeredUser->getUsername() &&
               password_verify($user->getPassword(), $registeredUser->getPassword())){
                throw new \WrongCredentialsException("Wrong credentials");
            }
        }
        $this->loginUser();
    }

    public function authenticateUserWithCookies(User $user) {

        $users = $this->DAL->getUserCookies();


        foreach ($users as  $registeredUser) {
            if (!$user->getUsername() === $registeredUser->getUsername() &&
                $user->getPassword() === $registeredUser->getPassword()){
                throw new \WrongCredentialsException("Wrong credentials");
            }
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