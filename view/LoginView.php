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
    private static $messageKey = "LoginView::TempMessage";
    private static $welcomeMessage = "Welcome";
    private static $goodbyeMessage = "Bye bye!";

    private $sessionModel;
    private $loginModel;
    private $message;


    public function __construct(\model\SessionModel $sessionModel, \model\LoginModel $loginModel) {
        $this->sessionModel = $sessionModel;
        $this->loginModel = $loginModel;
    }

    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @param $userIsLoggedIn, bool whether the user is logged in
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {
        $response = "";
        $message = "";

        if ($this->loginModel->userIsLoggedIn()) {
            if ($this->didUserPressLogin()) {
                $this->setMessage(self::$welcomeMessage, true);
                $this->reloadPage();
            } else {
                $message = $this->getMessage();
            }
            $response .= $this->generateLogoutButtonHTML($message);
        } else {
            if ($this->didUserPressLogout()) {
                $this->setMessage(self::$goodbyeMessage, true);
                $this->reloadPage();
            } else {
                $message = $this->getMessage();
            }
            $response .= $this->generateLoginFormHTML($message);

        }
        return $response;
    }


    /**
     * Returns a message set to the $_SESSION-array if one exists, for the
     * messages that needs to persist between redirects. If such message does
     * not exist, checks the member variable message that holds error-messages
     * to be shown on the login-screen. These does not need to be in $_SESSION
     * since it saves POST-data.
     *
     * @return null|string, message for the user, null string if no message is set
     */
    private function getMessage() {
        $message = "";
        if ($this->sessionModel->sessionDataExist(self::$messageKey)) {
            $message = $this->sessionModel->getSessionDataAndUnset(self::$messageKey);
        } elseif ($this->message != null) {
            $message = $this->message;
        }
        return $message;
    }



    /**
     * public for now so the controller can set message
     * TODO: fix logic to set messages for error in the view instead of passing Exception->getMessage()
     * @param $message, String feedback to the user
     * @param $isSessionVariable, bool if the message needs to persist a redirect
     */
    public function setMessage($message, $isSessionVariable = false) {
        if ($isSessionVariable) {
            $this->sessionModel->setSessionData(self::$messageKey, $message);
        } else {
            $this->message = $message;
        }
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

    /**
    * @return User, object of \model\User
    */
    public function getUser() {
        return new User($this->getRequestUserName(), $this->getRequestPassword());
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