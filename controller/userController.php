<?php
session_start();
include dirname(__DIR__) . "/model/userModel.php";

class userController
{
    public $firstname = '';
    public $lastname = '';
    public $email = '';
    public $password = '';
    public $role;
    public $userModelObject;
    public $userId = '';
    public $editUserId;
    public $errors = array("firstname_error" => "", "lastname_error" => "", "email_error" => "", "password_error" => "", "role_error" => "");

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

        // var_dump(preg_match_all("^(?=.*SELECT.*FROM)(?!.*(?:CREATE|DROP|UPDATE|INSERT|ALTER|DELETE|ATTACH|DETACH)).*$", $this->firstname));

        // validation
        if (empty($this->firstname)) {
            // $this->errors['firstname_error'] = "Please enter the firstname.";
        }
        if (preg_match("/\b(select|insert|update|delete|drop|truncate|alter|union|create|exec|--|#|;)\b/i", $this->firstname)) {
            $this->errors['firstname_error'] = "Please enter a valid first name";
        }

        if (empty($this->lastname)) {
            // $this->errors['lastname_error'] = "Please enter the lastname.";
        }
        if (preg_match("/\b(select|insert|update|delete|drop|truncate|alter|union|create|exec|--|#|;)\b/i", $this->lastname)) {
            $this->errors['lastname_error'] = "Please enter a valid last name";
        }

        if (empty($this->email)) {
            // $this->errors['email_error'] = "Please enter the  email address.";
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            // $this->errors['email_error'] = "Please enter the valid email address.";
        }

        if (empty($this->password)) {
            // $this->errors['password_error'] = "Please enter the  password.";
        }
        if (preg_match("/\b(select|insert|update|delete|drop|truncate|alter|union|create|exec|--|#|;)\b/i", $this->password)) {
            $this->errors['password_error'] = "Please enter a valid password";
        }

        if (empty($this->role)) {
            // $this->errors['role_error'] = 'please enter a user role.';
        }

        if (preg_match("/\b(select|insert|update|delete|drop|truncate|alter|union|create|exec|--|#|;)\b/i", $this->role)) {
            $this->errors['role_error'] = "Please enter a valid role";
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
        return  $this->userModelObject->edituserData($editUserId);
    }

    public function updateUserDetails($userEditId, $firstname, $lastname, $email, $role)
    {
        $isUpdate = $this->userModelObject->updateUserData($userEditId, $firstname, $lastname, $email, $role);

        if ($isUpdate) {
            $_SESSION['isEdit'] = false;
            header("Location: /Dashboard/view/AdminHome.php ");
            exit;
        } else {
            $_SESSION['isEdit'] = true;
            // header("Location: {$_SERVER['PHP_SELF']} ");
            // return "ERROR: Data was not updated.";
            // exit;
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
        // $_SESSION['isEdit'] = false;
        $userControllerObj->InsertData();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }

    if (isset($_POST['editUser'])) {
        $_SESSION['isEdit'] = true;
        $userEditId = $_POST['editUserId'];
        $data = $userControllerObj->editUserDetails($userEditId);
    }

    if (isset($_POST['update_btn'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $id = $_POST['userUpdateID'];
        $userControllerObj->updateUserDetails($id, $firstname, $lastname, $email, $role);
    }

    if (isset($_POST['deleteUser'])) {
        $userControllerObj->deleteUserDetails();
        header("Location: " . "/Dashboard/view/AdminHome.php");
        exit;
    }

    if (isset($_POST['create_user'])) {
        $_SESSION['isEdit'] = false;
        // header('Location: /Dashboard/view/AddUser.php');
        // exit();
    }
}
$userControllerObj = new userController();
