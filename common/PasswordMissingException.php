<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-20
 * Time: 19:15
 */
class PasswordMissingException extends Exception {

    public function __construct($message = null, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}