<?php

namespace common;

/**
 * Interface for setting and getting data that should be temporary
 * e.g messages
 * @package view
 */

interface ITempDataHandler {
    public function getTempData($key);
    public function setTempData($key, $value);

}