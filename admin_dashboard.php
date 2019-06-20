<?php
require_once('classes/Autoloader.php');
Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-6">
            <h2>Admin dashboard</h2>
        </div>
        <div class="col-md-6 text-right">
            <?php
            if (Session::loginStatus()) {
                if (Session::adminStatus()) {
                    ?> <a href="home.php" class="btn btn-primary">Home</a> <?php
                } else {
                    header('Location: Home.php');
                    die;
                }
                ?> <a href="logout.php" class="btn btn-primary">Log uit</a> <?php
            } else {
                header('Location: Home.php');
                die;
            }
            ?>
        </div>
        <div class="col-md-12">
            <h4>Gebruikers:</h4>
            <?php
            if (isset($_GET['del_id'])) {
                $del_id = $_GET['del_id'];
                User::removeUser($del_id);
            }

            User::displayUsers(User::fetchUsers());
            ?>
        </div>
    </div>
</div
</body>
</html>