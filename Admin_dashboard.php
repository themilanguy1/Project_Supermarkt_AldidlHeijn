<?php
require_once('Classes/Autoloader.php');
Session::Start();
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
        <div class="col-md-8">
            <h2>Admin dashboard</h2>
        </div>
        <div class="col-md-4 text-right">
            <?php
            if (Session::LoginStatus()) {
                ?> <a href="Logout.php" class="btn btn-primary">Log uit</a> <?php
                if (Session::AdminStatus()) {
                    ?> <a href="Home.php" class="btn btn-primary">Home</a> <?php
                } else {
                    header('Location: Home.php');
                    die;
                }
            } else {
                header('Location: Home.php');
                die;
            }
            ?>
        </div>
    </div>
</div
</body>
</html>