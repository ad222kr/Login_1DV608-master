<?php

namespace controller;


class LoginController {

    private $isLoggedIn;
    private $loginView;
    private $user; //

    public function __construct(\LoginView $loginView, \model\User $user) {

        $this->loginView = $loginView;
        $this->user = $user;
        $this->isLoggedIn = false;

    }
}