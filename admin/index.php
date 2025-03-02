<?php
    session_start();
    $user = $_SESSION["user"];
    if($user->role_id != 2) {
        header("location: login.php?auth=fail");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Admin</title>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
</head>
<body>
    <h1>Hello Admin</h1>
    
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>