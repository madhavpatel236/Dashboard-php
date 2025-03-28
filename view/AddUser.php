<?php
// var_dump(($_SESSION['userId']));
include dirname(__DIR__) . "/controller/userController.php";

if ($_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script defer src="../assets/AddUserFormauth.js"></script>
</head>

<body>

    <form id="addUserForm" name="addUserForm" method="post">
        <?php if ($_SESSION['isEdit']): ?>
            <h2 class="heading-addUser"> Edit User </h2>
        <?php endif; ?>
        <?php if (!$_SESSION['isEdit']): ?>
            <h2 class="heading-addUser"> Add User </h2>
        <?php endif ?>

        <?php if ($_SESSION['isEdit']): ?>
            <input type="hidden" id="userUpdateID" name='userUpdateID' value=" <?php echo $_POST['editUserId'] ?> " />
        <?php endif ?>

        <lable class="lable" for="firstname"> First name: </lable>
        <input class="input" id="firstname" name="firstname" value="<?php if ($data['firstname']) {
                                                                        echo $data['firstname'];
                                                                    } elseif ($_POST['firstname']) {
                                                                        echo $_POST['firstname'];
                                                                    } ?> " />
        <span class="error" name="firstname_error" id="firstname_error"> <?php echo ($userControllerObj->errors['firstname_error']) ?>  </span>


        <lable class="lable" for="lastname"> Last name: </lable>
        <input class="input" id="lastname" name="lastname" value="<?php if ($data['lastname']) {
                                                                        echo $data['lastname'];
                                                                    } elseif ($_POST['lastname']) {
                                                                        echo $_POST['lastname'];
                                                                    } ?> " />
        <span class="error" name="lastname_error" id="lastname_error"> <?php echo ($userControllerObj->errors['lastname_error']) ?> </span>

        <lable class="lable" for="email"> Email: </lable>
        <input class="input" id="email" name="email" value="<?php if ($data['email']) {
                                                                echo $data['email'];
                                                            } elseif ($_POST['email']) {
                                                                echo $_POST['email'];
                                                            }   ?>" />
        <span class="error" name="email_error" id="email_error"> <?php echo ($userControllerObj->errors['email_error']) ?> </span>

        <?php if (!$_SESSION['isEdit']): ?>
            <lable class="lable" for="password"> Password: </lable>
            <div class="password-container" style="position: relative;">
                <input type="password" class="input" id="password" name="password" value="<?php echo $data['password'] ?? $_POST['password'] ?? ''; ?>" />
                <span class="toggle-eye" onclick="togglePassword()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">👁️</span>
            </div>
            <span class="error" name="password_error" id="password_error"> <?php echo ($userControllerObj->errors['password_error']) ?> </span>
        <?php endif; ?>



        <?php if ($_SESSION['isEdit']): ?>
            <input type="hidden" class="input" id="password" name="password" value="<?php if ($data['password']) {
                                                                                        echo $data['password'];
                                                                                    } elseif ($_POST['password']) {
                                                                                        echo $_POST['password'];
                                                                                    }  ?>" />
        <?php endif; ?>

        <lable class="lable" for="role"> Role: </lable>
        <select name="role">
            <option id="roles" name="role" value="user">User</option>
            <option id="roles" name="role" value="admin">Admin</option>
        </select>

        <span class="error" name="role_error" id="role_error"> <?php echo ($userControllerObj->errors['role_error']) ?> </span>


        <?php if (!$_SESSION['isEdit']): ?>
            <button id="submit_btn" name="submit_btn"> Submit </button>
        <?php endif; ?>
        <?php if ($_SESSION['isEdit']): ?>
            <button id="update_btn" name="update_btn"> Update </button>
        <?php endif; ?>
    </form>
</body>

<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    }
</script>


</html>