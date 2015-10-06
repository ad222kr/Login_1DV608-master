<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-06
 * Time: 19:28
 */

namespace common;


class UserNotRegisteredException extends \Exception {
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}