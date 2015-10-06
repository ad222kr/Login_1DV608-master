<?php

namespace common;
use model\User;

/**
 * Lets other classes access the $_SESSION superglobal array
 * via interfaces, to prevent access to the same index
 *
 * Class SessionHandler
 * @package common
 */

class SessionHandler implements ILoginStateHandler, ITempMessageHandler {

    private static $sessionUserLocation = "SessionHandler::loggedInUser";
    private static $messageKey = "SessionHandler::TempMessage";

    public function __construct() {
        session_start();
    }

    public function setMessage($message) {
        assert(is_string($message), "Argument \$message needs to be of type string");
        $this->setData(self::$messageKey, $message);
    }

    public function getMessage() {
        if ($this->exists(self::$messageKey))
            return $this->getAndUnset(self::$messageKey);

        return "";
    }

    public function getLoggedInUser(){
        if ($this->exists(self::$sessionUserLocation)) {
            return $this->getData(self::$sessionUserLocation);
        }
    }


    public function setLoggedIn(User $user) {
        $this->setData(self::$sessionUserLocation, $user);
    }

    public function isLoggedIn() {
        if ($this->exists(self::$sessionUserLocation))
            return true;

        return false;
    }

    public function setLoggedOut() {
        $this->unsetData(self::$sessionUserLocation);
    }

    private function setData($key, $value) {
        $_SESSION[$key] = $value;
    }

    private function getData($key) {
        if ($this->exists($key))
            return $_SESSION[$key];

        return null;
    }

    private function unsetData($key) {
        if ($this->exists($key))
            unset($_SESSION[$key]);

    }

    private function getAndUnset($key) {
        $tempData = $this->getData($key);
        $this->unsetData($key);
        return $tempData;
    }

    private function exists($key) {
        return isset($_SESSION[$key]);
    }

}