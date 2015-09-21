<?php

namespace view;


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
    private static $goodbyeMessage = "Bye bye!";
    private static $nameMissingMessage = "Username is missing";
    private static $passwordMissingMessage = "Password is missing";
    private static $wrongCredentialsMessage = "Wrong name or password";

    private $sessionHandler;
    private $loginModel;
    private $message = null;


    public function __construct(\common\SessionHandler $sessionHandler, \model\LoginModel $loginModel) {
        $this->sessionHandler = $sessionHandler;
        $this->loginModel = $loginModel;
    }

    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {
        $response = "";
        $message = "";

        if ($this->loginModel->userIsLoggedIn()) {
            if ($this->didUserPressLogin()) {
                $this->reloadPage();
            } else {
                $message = $this->getMessage();
            }
            $response .= $this->generateLogoutButtonHTML($message);
        } else {
            if ($this->didUserPressLogout()) {
                $this->reloadPage();
            } else {
                $message = $this->getMessage();
            }
            $response .= $this->generateLoginFormHTML($message);
        }
        return $response;
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

    public function setLoginSucceeded() {
        $this->setMessage(self::$welcomeMessage, true);
    }

    public function setLogoutSucceeded() {
        $this->setMessage(self::$goodbyeMessage, true);
    }

    public function setLoginFailed() {
        $this->setMessage(self::$wrongCredentialsMessage);
    }

    /**
    * @return User, object of \model\User
    */
    public function getUser() {
        try {
            return new User($this->getRequestUserName(), $this->getRequestPassword());
        } catch (\UsernameMissingException $e) {
            $this->setMessage(self::$nameMissingMessage);
        } catch (\PasswordMissingException $e) {
            $this->setMessage(self::$passwordMissingMessage);
        }
    }

    /**
     * Gets a message from the $_SESSION-array if there is any, else it takes the
     * member-variable.
     * @return null|string, message for the user, null string if no message is set
     */
    private function getMessage() {
        if (strlen($this->message) > 0) {
            return $this->message;
        }
        return $this->sessionHandler->getMessage();
    }

    /**
     * Sets a message to the $_SESSION-array if needed, else to the member variable
     * @param $message, String feedback to the user
     * @param $isSessionVariable, bool if the message needs to persist a redirect
     */
    private function setMessage($message, $isSessionVariable = false) {
        if ($isSessionVariable) {
            $this->sessionHandler->setMessage($message);
        } else {
            $this->message = $message;
        }
    }

    /**
    * @return string, username typed in the form
    */
    private function getRequestUserName() {
        if (isset($_POST[self::$name])) {
            return $_POST[self::$name];
        }
        return "";
    }

    /**
     * @return string, password typed in the form
     */
    private function getRequestPassword() {
        if (isset($_POST[self::$password])) {
            return $_POST[self::$password];
        }
        return "";
    }

    /**
     * @return bool - if the user pressed logout button
     */
    public function didUserPressLogout() {
        return isset($_POST[self::$logout]);
    }

    /**
     * @return bool - if the user pressed login button
     */
    public function didUserPressLogin() {
        return isset($_POST[self::$login]);
    }

    private function reloadPage() {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }
}