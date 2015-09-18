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

	private $message = "";
	private $loginModel;

	public function __construct(\model\LoginModel $loginModel) {
		$this->loginModel = $loginModel;
	}


	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($userIsLoggedIn) {

		$response = "";
		$message = "";

		if ($userIsLoggedIn) {
			if ($this->userWantsToLogin()){
				$this->message = self::$welcomeMessage;
			}
			$response .= $this->generateLogoutButtonHTML($this->message);
		} else {
			if ($this->userWantsToLogout()){
				$message = self::$goodbyeMessage;
				$this->redirect();
			} elseif (strlen($this->message) > 0) {
				$message = $this->message;
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

	//CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
	public function getRequestUserName() {
		if (isset($_POST[self::$name])) {
			return $_POST[self::$name];
		}
		return "";
	}

	public function getRequestPassword() {
		if (isset($_POST[self::$password])) {
			return $_POST[self::$password];
		}
		return "";
	}

	public function userWantsToLogout() {
		return isset($_POST[self::$logout]);
	}

	public function userWantsToLogin() {
		return isset($_POST[self::$login]);
	}

	public function redirect() {
		if ($_POST){
			header("Location: " . $_SERVER['REQUEST_URI']);
			exit();
		}
	}

	public function setMessage($message) {
		$this->message = $message;
	}
}