<?php
session_start();
include '../dbConnection.php';
class userModel
{
    public $isConnect;

    public $admin_userId;
    public $admin_firstName;
    public $admin_lastName;
    public $admin_email;
    public $admin_password;
    public $admin_role;

    public $userDetails = [];

    public function __construct()
    {
        $conf = new database();
        $this->isConnect = $conf->dbConnection();

        if ($this->isConnect) {
            echo "<script> console.log('Database connected sucessfully!!!'); </script>";
        } else {
            echo "<script> console.log('Database was not connected!!!z'); </script>";
        }
    }

    // admin auth
    public function authentication($email, $password)
    {
        // $admin = "SELECT * FROM userData WHERE role = 'admin' ";
        $admin = "SELECT * FROM userData WHERE Id = 1";
        $adminData = mysqli_query($this->isConnect, $admin);

        // $adminList = [];

        if ($adminData->num_rows > 0) {
            echo "<script> console.log('Admin fatched  sucessfully!') </script>";
            while ($row = $adminData->fetch_assoc()) {
                // $adminList[] = [
                //     'Id' => $row['Id'],
                //     'firstName' => $row['firstName'],
                //     'lastName' => $row['lastName'],
                //     'email' => $row['email'],
                //     'password' => $row['password'],
                //     'role' => $row['role']
                // ];
                $this->admin_userId = $row['Id'];
                $this->admin_firstName = $row['firstName'];
                $this->admin_lastName = $row['lastName'];
                $this->admin_email = $row['email'];
                $this->admin_password = $row['password'];
            }
            // var_dump($adminList);
        } else {
            echo " ADMIN not found";
        }

        if ($email === $this->admin_email && $password === $this->admin_password) {
            $_SESSION['authenticated'] = true;
            header("Location: " . "/Dashboard/view/AdminHome.php");
        } else {
            $userCheck = "SELECT * FROM userData WHERE email = '$email' and password = '$password'";
            $userCheckResult = mysqli_query($this->isConnect, $userCheck);

            if ($userCheckResult->num_rows > 0) {
                while ($row = $userCheckResult->fetch_assoc()) {
                    $_SESSION['authenticated'] = true;
                    header("Location: " . "/Dashboard/view/UserHome.php");
                }
            } else {
                echo 'NO user found';
                header("Location: " . "/Dashboard/view/Error.php");
            }
        }
    }

    // Insert data in db 
    public function createUser($firstname, $lastname, $email, $password, $role)
    {
        $userRole = strtolower($role);
        $table = "CREATE TABLE IF NOT EXISTS userData(        
        Id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(20) NOT NULL,
        lastName VARCHAR(20) NOT NULL,
        email VARCHAR(20) NOT NULL,
        password VARCHAR(20) NOT NULL,
        role VARCHAR(10) NOT NULL
        )";

        if ($this->isConnect->query($table)) {
            echo "<script> console.log('Table was created sucessfully!!!');  </script>";
        } else {
            echo __LINE__ .  $this->isConnect->error;
        }

        // Insert :
        $insertData = "INSERT INTO userData(firstName, lastName, email, password, role) VALUES ( '$firstname' , '$lastname' , '$email', '$password', '$userRole')";
        if ($this->isConnect->query($insertData)) {
            echo "<script> console.log('data added sucessfully!!!');  </script>";
        } else {
            echo __LINE__ .  $this->isConnect->error;
        }
    }

    public function edituserData($userId)
    {
        $user = " SELECT * FROM userData WHERE Id = '$userId' ";
        $userResult = mysqli_query($this->isConnect, $user);

        $userData = [];

        if ($userResult->num_rows > 0) {
            while ($row = $userResult->fetch_assoc()) {
                $userData = [
                    'firstname' => $row['firstName'],
                    'lastname' => $row['lastName'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                ];
            }
        }
        return $userData;
        // return $data;
    }

    // used in the AdminHomepage
    public function getAllUsereData()
    {
        $userData = " SELECT * FROM userData WHERE Id > 1";
        $userDataResult = mysqli_query($this->isConnect, $userData);

        if ($userDataResult->num_rows > 0) {
            while ($row = $userDataResult->fetch_assoc()) {
                $userDetails[] = [
                    'Id' => $row['Id'],
                    'firstName' => $row['firstName'],
                    'lastName' => $row['lastName'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'role' => $row['role']
                ];
            }
        }
        return $userDetails;
    }

    public function deleteIndividualUser($userId)
    {
        $delete = "DELETE FROM userData WHERE Id = '$userId'";
        $deleteResult = mysqli_query($this->isConnect, $delete);

        if ($deleteResult) {
            echo "<script> console.log('User was deleted successfully!'); </script>";
        } else {
            echo "<script> console.log('*ERROR: User was not deleted.'); </script>";
        }
    }
}


class adminViewModel {}

$userModelObj = new userModel();
// $userModelObj->edituserData(23);
