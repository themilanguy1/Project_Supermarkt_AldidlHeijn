<?php
require_once('Classes/Autoloader.php');
Autoloader::LoadClasses();
Autoloader::SessionStart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Home</h3>
        </div>
        <div class="col-md-4">
        <?php
        if (User::LoginStatus()) {
            ?> <a href="Logout.php" class="btn btn-primary">Log uit</a> <?php
            if (User::AdminStatus()) {
                ?> <a href="Admin_dashboard.php" class="btn btn-primary">Admin Dashboard</a> <?php
            } else {
                ?> <a href="User_dashboard.php" class="btn btn-primary">Gebruiker Dashboard</a> <?php
            }
        } else {
            ?> <a href="Login.php" class="btn btn-primary">Log in</a> <?php
        }
        ?>
    </div>
    <div class="col-md-12">
        <br>
        <h4>Producten</h4>
    </div>
    <?php
    Database::FetchProducts();
    ?>
</div>
</div
</body>
</html>