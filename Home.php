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
    <div class="row">
        <div class="col-md-8">
            <h3>Home</h3>
        </div>
        <div class="col-md-4">
            <?php
            if (Session::LoginStatus()) {
                ?> <a href="Logout.php" class="btn btn-primary">Log uit</a> <?php
                if (Session::AdminStatus()) {
                    ?> <a href="Admin_dashboard.php" class="btn btn-primary">Admin Dashboard</a> <?php
                } else {
                    ?> <a href="User_dashboard.php" class="btn btn-primary">Gebruiker Dashboard</a> <?php
                }
            } else {
                ?> <a href="Login.php" class="btn btn-primary">Log in</a> <?php
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Producten</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
            Utility::FetchCategoryButtons();
            ?>
        </div>
    </div>
    <div class="row">
        <?php
        if (isset($_GET['category']) && (!empty($_GET['category']))) {
            Products::Display(Products::Fetch($_GET['category']));
        } else {
            Products::Display(Products::Fetch());
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-top:0.5em;">
            <h4>Winkelmand</h4>
        </div>
        <div class="col-md-12">
            <?php
            // Add item.
            if (isset($_GET['add_product_id'], $_GET['add_product_name'], $_GET['add_product_price'], $_GET['add_product_quantity'])) {
                Cart::AddItem($_GET['add_product_id'], $_GET['add_product_name'], $_GET['add_product_price'], $_GET['add_product_quantity']);
            }

            // Remove item.
            if (isset($_GET['edit_quantity_product_id']) && $_GET['edit_product_quantity']) {
                Cart::EditQuantity($_GET['edit_quantity_product_id'], $_GET['edit_product_quantity']);
            }

            // Remove item.
            if (isset($_GET['remove_product_id'])) {
                Cart::RemoveItem($_GET['remove_product_id']);
            }

            // Empty cart.
            if (isset($_GET['empty_cart'])) {
                Cart::EmptyCart();
            }

            Cart::Display();
            ?>
        </div>
    </div>
</body>
</html>