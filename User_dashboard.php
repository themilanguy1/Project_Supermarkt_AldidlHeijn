<?php
require_once('Classes/Database.php');
require_once('Classes/User.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>User dashboard</h3>
        </div>
        <div class="col-md-4">
            <?php
            if(User::LoginStatus()) {
                ?>
                <a href="Loguit.php" class="btn btn-primary">Log uit</a>
                <a href="Home.php" class="btn btn-primary">Home</a>
                <?php
            } else {
                ?>
                <a href="Login.php" class="btn btn-primary">Log in</a>
                <?php
            }
            ?>
        </div>
    </div>
</div
</body>
</html>