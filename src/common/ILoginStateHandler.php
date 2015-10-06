<?php

namespace common;
use model\User;

/**
 * Interface for handling the state of a Users login-status,
 * to hide implementation of the SessionHandler class and not
 * access unwanted indexes of the $_SESSION array
 *
 * Interface ILoginStateHandler
 * @package model
 */
interface ILoginStateHandler {
    public function setLoggedIn(User $user);
    public function isLoggedIn();
    public function setLoggedOut();
    public function getLoggedInUser();
}