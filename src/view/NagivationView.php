<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:40
 */

namespace view;


class NagivationView {

    private static $registerName = "register";




    public function userWantsToRegister() {
        return $this->registerIsSet();
    }

    public function render($isLoggedIn) {
        if (!$isLoggedIn) {
            if (!$this->registerIsSet())
                return $this->getLinkToRegistration();
            else
                return $this->getLinkToLogin();
        }
    }

    private function getLinkToRegistration() {
        return "<a href='?register'>Register a new user</a>";
    }

    private function getLinkToLogin() {
        return "<a href='?'>Back to login</a>";
    }

    private function registerIsSet() {
        return isset($_GET[self::$registerName]);
    }
}