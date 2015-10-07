<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:38
 */

namespace view;


class RegisterView {

	private static $registerName = "?register";
	private static $messageID = "RegisterView::Message";
	private static $usernameID = "RegisterView::UserName";
	private static $passwordID = "RegisterView::Password";
	private static $passwordRepeatID = "RegisterView::PasswordRepeat";

    private $loginStateHandler; //not needed here probably?
    private $registerModel;

    public function __construct(\common\ILoginStateHandler $loginStateHandler, \model\RegisterModel $registerModel) {
        $this->loginStateHandler = $loginStateHandler; // think i need this to add username to field after registration
        $this->registerModel = $registerModel;
    }



    public function response() {
		//TODO: fix proper form-string

		return '<form action="' . self::$registerName . '" method="post" enctype="multipart/formdata">
 				<fieldset>
 				<legend>Register a new user - Write username and password</legend>
 				<p id="' . self::$messageID . '"></p>
 				<label for="' . self::$usernameID .'" >Username :</label>
 				<input type="text" size="20" name="' . self::$usernameID .'" id="' . self::$usernameID .'" value="" />
 				<br/>
 				<label for="' . self::$passwordID .'" >Password :</label>
 				<input type="password" size="20" name="' . self::$passwordID .'" id="' . self::$passwordID.'" value="" />
				<br/>
 				<label for="' . self::$passwordRepeatID .'" >Repeat password :</label>
 				<input type="password" size="20" name="' . self::$passwordRepeatID .'" id="' . self::$passwordRepeatID.'" value="" />
 				<br/>
 				<input id="submit" type="submit" name="DoRegistration" value="Register" />
 				<br/>
 				</fieldset>
 				</form>';
    }

}