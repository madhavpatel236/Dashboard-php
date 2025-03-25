<?php
include dirname(__DIR__) . "/model/userModel.php";

class userController
{
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $password = '';
    public $userModelObject;
    public $authControllerObject = '';
    public $userId = '';
    public $editUserId;
    public $errors = array("firstname_error" => "", "lastname_error" => "", "email_error" => "", "password_error" => "",);

    public function __construct()
    {
        $this->userModelObject = $GLOBALS['userModelObj'];
        $this->firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $this->lastname = isset($_POST['lastname']) ? $_POST['lastname'] : "";
        $this->email = isset($_POST['email']) ? $_POST['email'] : "";
        $this->password = isset($_POST['password']) ? $_POST['password'] : "";
        $this->userId = isset($_POST['deleteUser']) ? $_POST['userId'] : "";
        $this->editUserId = $_POST['editUserId'];
        // var_dump($this->authControllerObject);

        // validation
        if (empty($this->firstname)) {
            $this->errors['email_error'] = "Please enter the admin email address.";
        }
        if (empty($this->lastname)) {
            $this->errors['password_error'] = "Please enter the admin password.";
        }
        if (empty($this->email)) {
            $this->errors['email_error'] = "Please enter the admin email address.";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email_error'] = "Please enter the valid email address.";
        }
        if (empty($this->password)) {
            $this->errors['password_error'] = "Please enter the admin password.";
        }
    }

    public function InsertData()
    {
        if ($this->firstname && $this->lastname && $this->email && $this->password) {
            return $this->userModelObject->createUser($this->firstname, $this->lastname, $this->email, $this->password);
        }
    }

    public function  editUserDetails()
    {
        return $this->userModelObject->edituserData($this->editUserId);
        // print_r($value);
        // return $value;
    }

    public function getAllUserData()
    {
        return $this->userModelObject->getAllUsereData();
    }

    public function deleteUserDetails()
    {
        $this->userModelObject->deleteIndividualUser($this->userId);
    }
}

$userControllerObj = new userController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userControllerObj = new userController();
    if (isset($_POST['submit_btn'])) {
        $userControllerObj->InsertData();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }

    if (isset($_POST['editUser'])) {
        $userControllerObj->editUserDetails();
        // print_r($userControllerObj->editUserDetails()); 
        header("Location: " . "/Dashboard/view/AddUser.php");
        // exit;
    }

    if (isset($_POST['deleteUser'])) {
        $userControllerObj->deleteUserDetails();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }
}
