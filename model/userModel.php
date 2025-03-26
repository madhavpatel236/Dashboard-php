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
        $admin = "SELECT * FROM userData WHERE role = 'admin' ";
        $adminData = mysqli_query($this->isConnect, $admin);

        $adminList = [];

        if ($adminData->num_rows > 0) {
            echo "<script> console.log('Admin fatched sucessfully!') </script>";
            while ($row = $adminData->fetch_assoc()) {
                $adminList[] = [
                    'Id' => $row['Id'],
                    'firstName' => $row['firstName'],
                    'lastName' => $row['lastName'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'role' => $row['role']
                ];
            }
        } else {
            echo " ADMIN not found";
        }

        // check email id and password for the admin.
        foreach ($adminList as $admin) {
            $varifyPassword = password_verify($password, $admin['password']);
            // var_dump($varifyPassword);
            if ($admin['email'] === $email && $varifyPassword) {
                $_SESSION['authenticated'] = true;
                $_SESSION['credential_error'] = false;
                $_SESSION['role'] = 'admin';
                header("Location: /Dashboard/view/AdminHome.php");
                exit();
            }
        }

        $userCheck = "SELECT * FROM userData WHERE email = '$email'";
        $userCheckResult = mysqli_query($this->isConnect, $userCheck);
        if ($userCheckResult->num_rows > 0) {
            $user = mysqli_fetch_assoc($userCheckResult);
            if (password_verify($password, $user['password'])) {
                $_SESSION['authenticated'] = true;
                $_SESSION['credential_error'] = false;
                $_SESSION['role'] = 'user';
                header("Location: /Dashboard/view/UserHome.php");
                exit();
            } else {
                $_SESSION['credential_error'] = true;
                header("Location: /Dashboard");
                exit();
            }
        } else {
            // $_SESSION['credential_error'] = true;
            header("Location: /Dashboard");
            exit();
        }
    }

    // public function userPresent($email, $password)
    // {
    //     $getuser = "SELECT * FROM userData WHERE email = '$email' ";
    //     $getUserresult = mysqli_query($this->isConnect, $getuser);

    //     if ($getUserresult->num_rows > 0) {
    //         $row = $getUserresult->fetch_assoc();
    //         if (password_verify($password, $row['password'])) {
    //             // echo "present". $row['id'];
    //             return true;
    //         } else {
    //             // echo "not present". ", " . $email . ", " .$password;
    //             // $error= "User is not present";
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }

    // Insert data in db 
    public function createUser($firstname, $lastname, $email, $password, $role)
    {
        $userRole = strtolower($role);
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // $hashPassword = ($password, PASSWORD_DEFAULT);
        echo $hashPassword;

        $table = "CREATE TABLE IF NOT EXISTS userData(        
        Id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(20) NOT NULL,
        lastName VARCHAR(20) NOT NULL,
        email VARCHAR(20) NOT NULL,
        password VARCHAR(100) NOT NULL,
        role VARCHAR(10) NOT NULL
        )";

        if ($this->isConnect->query($table)) {
            echo "<script> console.log('Table was created sucessfully!!!');  </script>";
        } else {
            // echo __LINE__ .  $this->isConnect->error;
        }

        // Insert :
        $insertData = "INSERT INTO userData(firstName, lastName, email, password, role) VALUES ( '$firstname' , '$lastname' , '$email', '$hashPassword', '$userRole')";
        if ($this->isConnect->query($insertData)) {
            echo "<script> console.log('data added sucessfully!!!');  </script>";
        } else {
            // echo __LINE__ .  $this->isConnect->error;
        }
    }

    public function edituserData($userId)
    {
        $user = " SELECT * FROM userData WHERE Id = '$userId' ";
        $userResult = mysqli_query($this->isConnect, $user);
        
        if ($userResult->num_rows > 0) {
            while ($row = $userResult->fetch_assoc()) {
                // var_dump($row);
                $userData = [
                    'firstname' => $row['firstName'],
                    'lastname' => $row['lastName'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'role' => $row['role'],
                ];
            }
        }
        return $userData;
        // return $data;
    }

    // update userdata
    public function updateUserData($userId, $firstname, $lastname, $email, $role)
    {
        // echo  $userId;
        $update = " UPDATE userData SET firstName = '$firstname', lastName = '$lastname', email = '$email', role = '$role' WHERE Id = '$userId' ";
        $updateResult = mysqli_query($this->isConnect, $update);
        if($updateResult){
            $_SESSION['isEdit'] = false;
        } else {
            $_SESSION['isEdit'] = true;
        }
        return $updateResult;
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

$userModelObj = new userModel();
// $userModelObj->userPresent("madhav@elsner.com", "Madhav123");
// $userModelObj->updateUserData(7);
// $userModelObj->createUser( "parth123456", "patel", "parth@gmail.com", "patel@123", "user");
