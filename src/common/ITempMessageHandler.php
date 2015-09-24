<?php

namespace common;

/**
 * Interface for handling messages that needs to be stored in
 * $_SESSION, to hide implementation of the SessionHandler
 * class and not access unwanted indexes of the $_SESSION array
 * Interface ITempMessageHandler
 * @package view
 */

interface ITempMessageHandler {
    public function getMessage();
    public function setMessage($value);
}