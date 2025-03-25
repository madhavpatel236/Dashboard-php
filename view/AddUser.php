<?php
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
    <script defer src="../assets/AddUserFormauth.js "></script>
</head>

<body>

    <form id="addUserForm" name="addUserForm" method="post">
        <h2 class="heading-addUser"> Add User </h2>
        <lable class="lable" for="firstname"> First name: </lable>
        <input class="input" id="firstname" name="firstname" value="<?php echo $data['firstname'] ?>" />
        <span class="error" name="firstname_error" id="firstname_error"> </span>


        <lable class="lable" for="lastname"> Last name: </lable>
        <input class="input" id="lastname" name="lastname" value="<?php echo $data['lastname'] ?>" />
        <span class="error" name="lastname_error" id="lastname_error"> </span>

        <lable class="lable" for="email"> Email: </lable>
        <input class="input" id="email" name="email" value="<?php echo $data['email'] ?>" />
        <span class="error" name="email_error" id="email_error"> </span>

        <lable class="lable" for="password"> Password: </lable>
        <input class="input" id="password" name="password" value="<?php echo $data['password'] ?>"/>
        <span class="error" name="password_error" id="password_error"> </span>

        <lable class="lable" for="role"> Role: </lable>
        <input class="input" id="role" name="role" value="<?php echo $data['role'] ?>"/>
        <span class="role" name="role_error" id="role_error"> </span>

        <button id="submit_btn" name="submit_btn"> Submit </button>
    </form>
</body>

</html>