<?php

namespace controller;


use model\User;

class LoginController {

    private $loginModel;
    private $loginView;
    private $sessionModel;
    public function __construct(\model\LoginModel $loginModel, \model\SessionModel $sessionModel) {
        $this->loginModel = $loginModel;
        $this->sessionModel = $sessionModel;
        $this->loginView = new \view\LoginView($this->loginModel, $this->sessionModel);;
    }

    /**
     * @return bool - if the user is logged in or not
     */
    public function doLoginAction() {

        if ($this->loginView->userWantsToLogin()) {
            try {
                $user = $this->loginView->getUser();
                $this->loginModel->authenticateUser($user);
            } catch(\UsernameMissingException $e) {
                $this->loginView->setTempMessage($e->getMessage()); // TODO: change logic so view handles message output
            } catch(\PasswordMissingException $e) {
                $this->loginView->setTempMessage($e->getMessage()); // TODO: change logic so view handles message output
            } catch (\WrongCredentialsException $e) {
                $this->loginView->setTempMessage($e->getMessage()); // TODO: change logic so view handles message output
            }
        } else if ($this->loginView->userWantsToLogout()) {
            $this->loginModel->logoutUser();
        }
        return $this->loginModel->userIsLoggedIn();
    }

    public function getView() {
        return $this->loginView;
    }


}