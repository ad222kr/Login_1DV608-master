<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-22
 * Time: 16:16
 */

namespace common;


class CookieHandler {

    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';


    public function __construct() {

    }

    private function setCookie($name, $value, $expiresIn) {
        assert(is_string($name));
        assert(is_string($value));
        assert(is_int($expiresIn));

        // http://php.net/manual/en/function.setcookie.php#110193
        setcookie($name, $value, strtotime("+$expiresIn days"));
    }

    public function setRememberUserCookie($username,$password) {
        $this->setCookie(self::$cookieName, $username, 30);
        $this->setCookie(self::$cookiePassword, $this->getEncryptedPassword($password), 30);

    }

    public function userNameCookieExists() {

    }

    public function passWordCookieExists() {

    }

    private function getEncryptedPassword($password) {
        return hash("sha256", $password);
    }





}