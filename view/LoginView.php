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
	private static $goodbyeMessage = "Bye bye!";
	private static $messageKey = "tempMessage";

    private $sessionModel;
    private $message = null;

    public function __construct(\model\SessionModel $sessionModel) {
        $this->sessionModel = $sessionModel;
    }

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($userIsLoggedIn) {
        /* $response = "";

		if ($userIsLoggedIn) {
			if ($this->didUserPressLogin()){
				$this->setTempMessage(self::$welcomeMessage);
				$this->reloadPage();
			}
			$response = $this->generateLogoutButtonHTML($this->message);
		} else {
			if ($this->didUserPressLogout()){
				$this->setTempMessage(self::$goodbyeMessage);
				$this->reloadPage();
			}
			$response = $this->generateLoginFormHTML($this->message);
		}
        */
        $response = "";
        $message = "";

        if ($userIsLoggedIn) {
            if ($this->didUserPressLogin()) {
                $this->sessionModel->setSessionData(self::$messageKey, self::$welcomeMessage);
                $this->reloadPage();
            }
            $message = $this->generateMessage();
            $response = $this->generateLogoutButtonHTML($message);
        } else {
            if ($this->didUserPressLogut()) {
                $this->sessionModel->setSessionData(self::$messageKey, self::$goodbyeMessage);
                $this->reloadPage();
            }
            $message = $this->generateMessage();
            $response = $this->generateLoginFormHTML($message);
        }
        return $response;
	}

    /**
     * @return string, a message that shows feedback to the user
     */
    public function generateMessage() {
        $message = "";

        if ($this->sessionModel->getSessionData(self::$messageKey) != null) {
            $message = $this->sessionModel->getSessionDataAndUnset(self::$messageKey);
        } elseif ($this->message != null) {
            $message = $this->message;
        }

        return $message;
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
	public function didUserPressLogut() {
		return isset($_POST[self::$logout]);
	}


    /**
     * @return bool - if the user pressed login button
     */
	public function didUserPressLogin() {
		return isset($_POST[self::$login]);
	}


	private function reloadPage() {
		if ($_POST){
			header("Location: " . $_SERVER['REQUEST_URI']);
			exit();
		}
	}

	public function setMessage($message) {
		$this->message = $message;
	}
}