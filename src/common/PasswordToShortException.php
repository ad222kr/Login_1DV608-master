<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-07
 * Time: 19:24
 */

namespace common;


class PasswordToShortException extends \Exception{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}