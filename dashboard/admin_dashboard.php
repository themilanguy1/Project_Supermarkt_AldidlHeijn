<?php
require_once('../classes/Autoloader.php');
Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/dashboard.css">
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
                    ?> <a href="../home.php" class="btn btn-primary">Home</a> <?php
                } else {
                    header('Location: Home.php');
                    die;
                }
                ?> <a href="../logout.php" class="btn btn-primary">Log uit</a> <?php
            } else {
                header('Location: Home.php');
                die;
            }
            ?>
        </div>
        <div class="col-md-2">
            <h4>Gebruikers:</h4>
        </div>
        <div class="col-md-10">
<!--            <a href="products/add.php" class="btn btn-success"><i class="fas fa-plus"></i></a>-->
        </div>
        <div class="col-md-12">
        <?php
        if (isset($_GET['user_del_id'])) {
            $user_del_id = $_GET['user_del_id'];
            User::removeUser($user_del_id);
        }

        User::displayUsers(User::fetchUsers());
        ?>
        </div>
        <br>
        <div class="col-md-2">
            <h4>Producten:</h4>
        </div>
        <div class="col-md-10">
            <a href="products/add.php" class="btn btn-success"><i class="fas fa-plus"></i></a>
        </div>
        <div class="col-md-12">
            <?php
            if (isset($_GET['product_del_id'])) {
                $product_del_id = $_GET['product_del_id'];
                Products::removeProduct($product_del_id);
            }

            Products::displayProductList(Products::fetchProducts());
            ?>
        </div>
    </div>
</div
</body>
</html>