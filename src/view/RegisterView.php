<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:38
 */

namespace view;


class RegisterView {

    private $loginStateHandler; //not needed here probably?
    private $registerModel;

    public function __construct(\common\ILoginStateHandler $loginStateHandler, \model\RegisterModel $registerModel) {
        $this->loginStateHandler = $loginStateHandler;
        $this->registerModel = $registerModel;
    }

    public function response() {
        return "<form action='?register' method='post' enctype='multipart/form-data'>
				<fieldset>
				<legend>Register a new user - Write username and password</legend>
					<p id='RegisterView::Message'></p>
					<label for='RegisterView::UserName' >Username :</label>
					<input type='text' size='20' name='RegisterView::UserName' id='RegisterView::UserName' value='' />
					<br/>
					<label for='RegisterView::Password' >Password  :</label>
					<input type='password' size='20' name='RegisterView::Password' id='RegisterView::Password' value='' />
					<br/>
					<label for='RegisterView::PasswordRepeat' >Repeat password  :</label>
					<input type='password' size='20' name='RegisterView::PasswordRepeat' id='RegisterView::PasswordRepeat' value='' />
					<br/>
					<input id='submit' type='submit' name='DoRegistration'  value='Register' />
					<br/>
				</fieldset>
			</form>";
    }

}