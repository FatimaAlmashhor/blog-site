<?php

use Permission\AdminPermission;

require_once('../vendor/autoload.php');
$permission = new AdminPermission();
if (isset($_GET['do']) && $_GET['do'] == 'logout') {
    $permission->logout();
}


$checked = $permission->permissionAdmin();

if (!$checked) {
    header('location: ../login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/sidebar.css">
    <link rel="stylesheet" href="../dist/css/tailwind.css">
    <title>Dashbload</title>
</head>
<?php include('../templates/sidebar.php') ?>

<body>
    dashboard

    <!-- ===== IONICONS ===== -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <!-- ===== MAIN JS ===== -->
    <script src="../public/js/main.js"></script>
</body>

</html>