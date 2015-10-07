<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:38
 */

namespace view;


use common\PasswordDoNotMatchException;
use common\PasswordToShortException;
use common\RegistrationCredentialsMissingException;
use common\UsernameToShortException;
use model\RegisterCredentials;

class RegisterView extends BaseView
{

	private static $registerName = "?register";
	private static $messageID = "RegisterView::Message";
	private static $usernameID = "RegisterView::UserName";
	private static $passwordID = "RegisterView::Password";
	private static $passwordRepeatID = "RegisterView::PasswordRepeat";
	private static $register = "DoRegistration";

	private static $credentialsMissingMessage = "Username has too few characters, at least 3 characters. Password has too few characters, at least 6 characters.";
	private static $passwordToShortOrMissingMessage = "Password has too few characters, at least 6 characters.";
	private static $usernameToShortMessage = "Username has too few characters, at least 3 characters.";
	private static $passwordDoNotMatchMessage = "Passwords do not match.";

	private $registerModel;

	public function __construct(\common\ITempMessageHandler $tempMessageHandler, \model\RegisterModel $registerModel)
	{
		parent::__construct($tempMessageHandler);
		$this->registerModel = $registerModel;
	}


	public function response() {
		return $this->generateForm($this->getMessage());
	}




	public function getRegistrationCredentials() {

		try {
			$username = $this->getRequestUsername();
			$password = $this->getRequestPassword();
			$repeatPassword = $this->getRequestRepeatPassword();
			$test = new RegisterCredentials($username, $password, $repeatPassword);
			var_dump($test);
		} catch (RegistrationCredentialsMissingException $e) {
			$this->setMessage(self::$credentialsMissingMessage, true);
		} catch(UsernameToShortException $e) {
			$this->setMessage(self::$usernameToShortMessage, true);
		} catch(PasswordToShortException $e) {
			$this->setMessage(self::$passwordToShortOrMissingMessage, true);
		} catch(PasswordDoNotMatchException $e){
			$this->setMessage(self::$passwordDoNotMatchMessage, true);
		}
	}

	private function getRequestUsername()
	{
		if (isset($_POST[self::$usernameID])) {
			return $_POST[self::$usernameID];
		}
		return "";
	}

	private function getRequestPassword()
	{
		if (isset($_POST[self::$passwordID])) {
			return $_POST[self::$passwordID];
		}
		return "";
	}

	private function getRequestRepeatPassword() {
		if (isset($_POST[self::$passwordRepeatID])) {
			return $_POST[self::$passwordRepeatID];
		}
	}

	private function generateForm($message)
	{
		//TODO: fix proper form-string

		return '<form action="' . self::$registerName . '" method="post" enctype="multipart/formdata">
 				<fieldset>
 				<legend>Register a new user - Write username and password</legend>
 				<p id="' . self::$messageID . '">' . $message . '</p>
 				<label for="' . self::$usernameID . '" >Username :</label>
 				<input type="text" size="20" name="' . self::$usernameID . '" id="' . self::$usernameID . '" value="" />
 				<br/>
 				<label for="' . self::$passwordID . '" >Password :</label>
 				<input type="password" size="20" name="' . self::$passwordID . '" id="' . self::$passwordID . '" value="" />
				<br/>
 				<label for="' . self::$passwordRepeatID . '" >Repeat password :</label>
 				<input type="password" size="20" name="' . self::$passwordRepeatID . '" id="' . self::$passwordRepeatID . '" value="" />
 				<br/>
 				<input id="submit" type="submit" name="' . self::$register .'" value="Register" />
 				<br/>
 				</fieldset>
 				</form>';
	}

	public function userPressedRegister() {
		return isset($_POST[self::$register]);
	}

}

