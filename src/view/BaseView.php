<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-07
 * Time: 19:45
 */

namespace view;


use common\ITempDataHandler;

abstract class BaseView {

    private static $messageKey = "SessionHandler::TempMessage";
    protected static $registeredUsernameKey = "SessionHandler::Username";

    /**
     * @var \common\ITempDataHandler
     */
    protected $tempDataHandler;



    /**
     * @var String, Feedback message
     */
    protected $message = null;

    public function __construct(ITempDataHandler $tempDataHandler) {
        $this->tempDataHandler = $tempDataHandler;
    }

    protected function sanitizeInput($stringToSanitize) {
        assert(is_string($stringToSanitize));
        $sanitized = htmlspecialchars($stringToSanitize, ENT_COMPAT,'ISO-8859-1');
        return $sanitized;
    }

    public function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    protected function setMessage($message, $shouldPersistRedirect = false) {
        assert(is_string($message));
        assert(is_bool($shouldPersistRedirect));
        if ($shouldPersistRedirect) {
            $this->tempDataHandler->setTempData(self::$messageKey, $message);
        } else {
            $this->message = $message;
        }
    }

    protected function getMessage() {
        if (strlen($this->message) > 0) {
            return $this->message;
        }
        return $this->tempDataHandler->getTempData(self::$messageKey);
    }

}