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
    <title>Admin Home</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div>
        <form action='../view/AddUser.php'>
            <button type="submit" name="create_user">
                Create User
            </button>

        </form>
    </div>
    <h2 class="heading-adminHome"> Admin Page </h2>
    <table class="table" border="1">
        <td class="table-heading">ID</td>
        <td class="table-heading">First Name</td>
        <td class="table-heading">Last Name</td>
        <td class="table-heading">Email</td>
        <td class="table-heading">Roles</td>
        <td class="table-heading"></td>
        <td class="table-heading"></td>

        <?php foreach ($userControllerObj->getAllUserData() as $eachUser): ?>
            <?php if ($eachUser['role'] !== "admin"): ?>
                <tr class="table-body">
                    <td class="table-body-data"><?php echo htmlspecialchars($eachUser['Id']); ?></td>
                    <td class="table-body-data"><?php echo htmlspecialchars($eachUser['firstName']); ?></td>
                    <td class="table-body-data"><?php echo htmlspecialchars($eachUser['lastName']); ?></td>
                    <td class="table-body-data"><?php echo htmlspecialchars($eachUser['email']); ?></td>
                    <td class="table-body-data"><?php echo htmlspecialchars($eachUser['role']); ?></td>
                    <td class="table-body-data">
                        <form action="./AddUser.php" method="POST">
                            <input type="hidden" name="editUserId" value="<?php echo htmlspecialchars($eachUser['Id']); ?>">
                            <button type="submit" name="editUser" class="edit-btn"> Edit </button>
                        </form>
                    </td>
                    <td class="table-body-data">
                        <form action="../controller/userController.php" method="POST">
                            <input type="hidden" name="userId" value="<?php echo htmlspecialchars($eachUser['Id']); ?>">
                            <button type="submit" name="deleteUser" class="delete-btn"> Delete </button>
                        </form>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>
