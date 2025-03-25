<?php
require('./constants.php');
// include(__APPPATH__. "/controller/authController.php");
// include __DIR__ . '/controller/authController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/style.css">
    <script defer src="./assets/auth.js"></script>
</head>

<body>

    <body>
        <div id="loginForm" name="loginForm" class="form-container">
            <h2 class="form-title">Login</h2>
            <form action="./controller/authController.php" method="post">
                <label class="lable" for="email">Email:</label>
                <input class="input" id="email" name="email" type="email" />
                <span class="error" id="email_error"></span>

                <label class="lable" for="password">Password:</label>
                <input class="input" id="password" name="password" type="password" />
                <span class="error" id="password_error"></span>
                <span class="error" id="general_error"> <?php echo $errors['general_error'] ?> </span>

                <button class="btn-submit" name="submit">Submit</button>
            </form>
        </div>
    </body>


</body>

</html>