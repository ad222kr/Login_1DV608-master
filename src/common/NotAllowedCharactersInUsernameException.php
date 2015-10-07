<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-07
 * Time: 22:09
 */

namespace common;


class NotAllowedCharactersInUsernameException extends \Exception{
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}