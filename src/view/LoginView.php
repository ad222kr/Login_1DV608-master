<?php

namespace view;

use model\UserCredentials;

class LoginView extends BaseView {
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
     * @var \view\CookieHandler
     */
    private $cookieHandler;

    /**
     * @var \model\LoginModel
     */
    private $loginModel;

    /**
     * @param \common\ITempDataHandler $tempDataHandler
     * @param CookieHandler $cookieHandler
     * @param \model\LoginModel $loginModel
     */
    public function __construct(\common\ITempDataHandler $tempDataHandler, CookieHandler $cookieHandler,
                                \model\LoginModel $loginModel) {
        parent::__construct($tempDataHandler);
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

        $message = $this->getMessage();

        if ($this->loginModel->userIsLoggedIn())
            return $this->generateLogoutButtonHTML($message);

        return $this->generateLoginFormHTML($message);;
    }

    public function rememberUser() {
        $username = $this->getRequestUserName();
        $password = $this->loginModel->getTempPassword();
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
    }

    public function setLogoutSucceeded() {
        $this->setMessage(self::$goodbyeMessage, true);
    }

    public function setLoginFailed() {
        if ($this->userCredentialCookieExists()) {
            $this->setMessage(self::$wrongCookieInfoMessage);
        } else {
            $this->setMessage(self::$wrongCredentialsMessage);
        }
    }

    /**
    * @return UserCredentials, object of \model\User
    */
    public function getUser() {
        try {
            $user = null;
            $username = "";
            $password = "";
            $cookiePassword = "";

            if ($this->userCredentialCookieExists()) {
                $username .= $this->cookieHandler->getCookie(self::$cookieName);
                $cookiePassword .= $this->cookieHandler->getCookie(self::$cookiePassword);
            } else {
                $username .= $this->getRequestUserName();
                $password .= $this->getRequestPassword();
            }

            return new \model\UserCredentials($username, $password, $cookiePassword);

        } catch (\UsernameMissingException $e) {
            $this->setMessage(self::$nameMissingMessage);
        } catch (\PasswordMissingException $e) {
            $this->setMessage(self::$passwordMissingMessage);
        }
    }

    private function userCredentialCookieExists() {
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

    public function userWantsToLogout() {
        return isset($_POST[self::$logout]);
    }

    public function userWantsToLogin() {
        return isset($_POST[self::$login]) || $this->userCredentialCookieExists();
    }

    public function userWantsToBeRemembered() {
        return isset($_POST[self::$keep]);
    }

    /**
     * checks if there is a username stored in session of newly registered user
     *
     * @return string
     */
    private function getUsernameToForm() {

        $username = $this->tempDataHandler->getTempData(self::$registeredUsernameKey);
        if ($username != null)
            return $username;

        return $this->getRequestUserName();
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
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="'. $this->getUsernameToForm() . '" />

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