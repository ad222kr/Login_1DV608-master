<?php

namespace view;

use model\User;

class LoginView {
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private static $welcomeMessage = "Welcome";
    private static $rememberWelcomeMessage = "Welcome and you will be remembered";
    private static $goodbyeMessage = "Bye bye!";
    private static $nameMissingMessage = "Username is missing";
    private static $passwordMissingMessage = "Password is missing";
    private static $wrongCredentialsMessage = "Wrong name or password";
    private static $wrongCookieInfoMessage = "Wrong information in cookies";
    private static $welcomeWithCookieMessage = "Welcome back with cookie";

    /**
     * @var \common\ITempMessageHandler
     */
    private $tempMessageHandler;

    /**
     * @var \view\CookieHandler
     */
    private $cookieHandler;

    /**
     * @var \model\LoginModel
     */
    private $loginModel;

    /**
     * @var String, Feedback message
     */
    private $message = null;


    public function __construct(\common\ITempMessageHandler $tempMessageHandler, CookieHandler $cookieHandler,
                                \model\LoginModel $loginModel) {
        $this->tempMessageHandler = $tempMessageHandler;
        $this->loginModel = $loginModel;
        $this->cookieHandler = $cookieHandler;
    }

    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {

        if ($this->loginModel->userIsLoggedIn()){
            return $this->generateLogoutButtonHTML($this->getMessage());
        }

        return $this->generateLoginFormHTML($this->getMessage());
    }

    public function rememberUser() {
        $username = $this->getRequestUserName();
        $password = $this->loginModel->generateCookiePassword();
        $this->cookieHandler->setCookie(self::$cookieName, $username, 30);
        $this->cookieHandler->setCookie(self::$cookiePassword, $password, 30);
    }

    public function forgetUser() {
        $this->cookieHandler->deleteCookie(self::$cookieName);
        $this->cookieHandler->deleteCookie(self::$cookiePassword);
    }

    public function setLoginSucceeded() {
        if ($this->userWantsToBeRemembered()) {
            $this->rememberUser();
            $this->setMessage(self::$rememberWelcomeMessage, true);
        } elseif ($this->userCredentialCookieExists()) {
            $this->setMessage(self::$welcomeWithCookieMessage, true);
        } else {
            $this->setMessage(self::$welcomeMessage, true);
        }
        $this->reloadPage();
    }

    public function setLogoutSucceeded() {
        $this->setMessage(self::$goodbyeMessage, true);
        $this->reloadPage();
    }

    public function setLoginFailed($isCookieLogin) {
        if ($isCookieLogin) {
            $this->setMessage(self::$wrongCookieInfoMessage);
        } else {
            $this->setMessage(self::$wrongCredentialsMessage);
        }
    }

    /**
    * @return User, object of \model\User
    */
    public function getUser() {
        try {
            $user = null;
            $username = "";
            $password = "";
            if ($this->userCredentialCookieExists()) {
                $username = $this->cookieHandler->getCookie(self::$cookieName);
                $password = $this->cookieHandler->getCookie(self::$cookiePassword);
            } else {
                $username = $this->getRequestUserName();
                $password = $this->getRequestPassword();
            }


            return new \model\User($username, $password);

        } catch (\UsernameMissingException $e) {
            $this->setMessage(self::$nameMissingMessage);
        } catch (\PasswordMissingException $e) {
            $this->setMessage(self::$passwordMissingMessage);
        }
    }

    /**
     * Gets a message from the $_SESSION-array if there is any, else it takes the
     * member-variable.
     * @return string, message for the user, empty if no message is set
     */
    private function getMessage() {
        if (strlen($this->message) > 0) {
            return $this->message;
        }
        return $this->tempMessageHandler->getMessage();
    }

    /**
     * @param $message, String feedback to the user
     * @param $shouldPersistRedirect, bool if the message needs to persist a redirect
     */
    private function setMessage($message, $shouldPersistRedirect = false) {
        assert(is_string($message));
        assert(is_bool($shouldPersistRedirect));
        if ($shouldPersistRedirect) {
            $this->tempMessageHandler->setMessage($message);
        } else {
            $this->message = $message;
        }
    }

    public function userCredentialCookieExists() {
        if ($this->cookieHandler->getCookie(self::$cookieName) != null &&
            $this->cookieHandler->getCookie(self::$cookiePassword) != null) {
            return true;
        }
        return false;
    }

    private function getRequestUserName() {
        if (isset($_POST[self::$name])) {
            return $this->sanitizeInput($_POST[self::$name]);
        }
        return "";
    }

    private function getRequestPassword() {
        if (isset($_POST[self::$password])) {
            return $this->sanitizeInput($_POST[self::$password]);
        }
        return "";
    }

    public function didUserPressLogout() {
        return isset($_POST[self::$logout]);
    }

    public function didUserPressLogin() {
        return isset($_POST[self::$login]);
    }

    public function userWantsToBeRemembered() {
        return isset($_POST[self::$keep]);
    }

    private function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    private function sanitizeInput($stringToSanitize) {
        assert(is_string($stringToSanitize));
        $sanitized = htmlspecialchars($stringToSanitize, ENT_COMPAT,'ISO-8859-1');
        return $sanitized;
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLogoutButtonHTML($message) {
        return '
            <form  method="post" >
                <p id="' . self::$messageId . '">' . $message .'</p>
                <input type="submit" name="' . self::$logout . '" value="logout"/>
            </form>
        ';
    }

    /**
     * Generate HTML code on the output buffer for the logout button
     * @param $message, String output message
     * @return  void, BUT writes to standard output!
     */
    private function generateLoginFormHTML($message) {
        return '
            <form method="post" >
                <fieldset>
                    <legend>Login - enter Username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'.$this->getRequestUserName().'" />

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" />

                    <label for="' . self::$keep . '">Keep me logged in  :</label>
                    <input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

                    <input type="submit" name="' . self::$login . '" value="login" />
                </fieldset>
            </form>
        ';
    }
}