<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-09-20
 * Time: 19:03
 */



class WrongCredentialsException extends Exception{

    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}