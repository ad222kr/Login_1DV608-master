<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-10-02
 * Time: 18:38
 */

namespace controller;


class RegisterController {

    /**
     * @var \model\RegisterModel
     */
    private $registerModel;

    /**
     * @var \view\RegisterView
     */
    private $registerView;

    /**
     * @param \model\RegisterModel $registerModel
     * @param \view\RegisterView $registerView
     */
    public function __construct(\model\RegisterModel $registerModel, \view\RegisterView $registerView) {
        $this->registerModel = $registerModel;
        $this->registerView = $registerView;
    }

    public function doRegisterAction() {
        if ($this->registerView->userPressedRegister()) {

            try{
                $registrationCredentials = $this->registerView->getRegistrationCredentials();
                if ($registrationCredentials == null) return;
                $this->registerModel->registerUser($registrationCredentials);
                $this->registerView->setRegistrationSuccess();
            } catch (\common\UsernameTakenException $e) {
                $this->registerView->setRegistrationFailed();
            } catch (\Exception $e) {
                $this->registerView->setDatabaseError();
            }
        }
    }

    /**
     * @return \view\RegisterView
     */
    public function getView() {
        return $this->registerView;
    }
}