<?php

include "../model/userModel.php";
class authController
{
    public $email;
    public $password;
    public $userModelObject;
    public $errors = array("email_error" => '', "password_error" => '', "general_error" => '');

    public function __construct()
    {
        $obj = new userModel();
        $this->userModelObject = $obj;
        // var_dump($this->userModelObject);

        $this->email = isset($_POST['email']) ? $_POST['email'] : '';
        $this->password = isset($_POST['password']) ? $_POST['password'] : '';

        // validation
        if (empty($this->email)) {
            $this->errors['email_error'] = "Please enter the admin email address.";
        }
        if (empty($this->password)) {
            $this->errors['password_error'] = "Please enter the admin password.";
        }
    }

    public function authUser()
    {
        $this->userModelObject->authentication($this->email, $this->password);
    }

    public function getUser()
    {
        $data = $this->userModelObject->getUser();
        return $data;
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $authControllerObj = new authController();


    if (isset($_POST['submit'])) {
        $authControllerObj->authUser();
        $authControllerObj->getUser();
    }
}

$authControllerObj = new authController();
