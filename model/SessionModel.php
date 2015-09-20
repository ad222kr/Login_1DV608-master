<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-20
 * Time: 16:25
 */

namespace model;


class SessionModel {

    public function __construct() {
        session_start();
    }

    public function setSessionData($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function getSessionData($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function unsetSessionData($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function getSessionDataAndUnset($key) {
        $tempData = $this->getSessionData($key);
        $this->unsetSessionData($key);
        return $tempData;
    }

    public function sessionDataExist($key) {
        return isset($_SESSION[$key]);
    }



}