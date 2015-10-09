<?php

namespace view;


class CookieHandler {

    private static $cookiePersistTime = 60;

    public function setCookie($name, $value, $expiresIn) {
        assert(is_string($name));
        assert(is_string($value));
        assert(is_int($expiresIn));

        setcookie($name, $value, time() + self::$cookiePersistTime);
    }

    public function getCookie($name) {
        if (isset($_COOKIE[$name]))
            return $_COOKIE[$name];

        return null;
    }

    public function deleteCookie($name) {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]);
            setcookie($name, null, -1); // remove cookie INSTANTLY
        }
    }
}