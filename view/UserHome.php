<?php
include '../controller/authController.php';

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
</head>

<body>
    <div>
        <h1>Hello USER</h1>
        <div>

        </div>
    </div>
</body>

</html>