<?php
include '../controller/authController.php';

if ($_SESSION['authenticated'] !== true) {
    header("Location: ../index.php");
    exit;
}

// echo "<pre>" . var_dump($authControllerObj->getUser());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Hello USER</h1>
        <div>
            First Name: <span> <?php echo ($authControllerObj->getUser()[0]['firstname']) ?> </span> <br /><br />
            Last Name: <span> <?php echo ($authControllerObj->getUser()[0]['lastname']) ?> </span> <br /><br />
            Email: <span> <?php echo ($authControllerObj->getUser()[0]['email']) ?> </span> <br /><br />
            role: <span> <?php echo ($authControllerObj->getUser()[0]['role']) ?> </span> <br /><br />
        </div>
    </div>
</body>

</html>