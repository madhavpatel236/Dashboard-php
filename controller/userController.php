<?php
include dirname(__DIR__) . "/model/userModel.php";

class userController
{
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $password = '';
    public $role;
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
        $this->role = isset($_POST['role']) ? $_POST['role'] : "";
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
        if ($this->firstname && $this->lastname && $this->email && $this->password && $this->role) {
            return $this->userModelObject->createUser($this->firstname, $this->lastname, $this->email, $this->password, $this->role);
        }
    }

    public function  editUserDetails($editUserId)
    {
        return $this->userModelObject->edituserData($editUserId);
    }

    public function updateUserDetails($userEditId, $firstname, $lastname, $role)
    {
        $isUpdate = $this->userModelObject->updateUserData($userEditId, $firstname, $lastname, $role);

        if ($isUpdate) {
            header("Location: /Dashboard/view/AdminHome.php ");
            exit;
        } else {
            echo "ERROR: Data was not updated.";
        }
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
    $userEditId;

    if (isset($_POST['submit_btn'])) {
        $userControllerObj->InsertData();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }

    if (isset($_POST['editUser'])) {
        $userEditId = $_POST['editUserId'];
        // echo $userEditId;
        $data = $userControllerObj->editUserDetails($userEditId);
    }

    if (isset($_POST['update_btn'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
            // echo $userEditId;
        $id = $_POST['userUpdateID'];
        $userControllerObj->updateUserDetails($id, $firstname, $lastname, $role);
    }

    if (isset($_POST['deleteUser'])) {
        $userControllerObj->deleteUserDetails();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }
}
$userControllerObj = new userController();
