<?php
require_once('Classes/Autoloader.php');
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
        <div class="col-md-7">
            <h2>Home</h2>
        </div>
        <div class="col-md-5 text-right">
            <?php
            if (Session::loginStatus()) {
                ?> <a href="Logout.php" class="btn btn-primary">Log uit</a> <?php
                if (Session::adminStatus()) {
                    ?> <a href="admin_dashboard/index.php" class="btn btn-primary">Admin Dashboard</a> <?php
                } else {
                    ?> <a href="User_dashboard.php" class="btn btn-primary">Gebruiker Dashboard</a> <?php
                }
            } else {
                ?> <a href="Login.php" class="btn btn-primary">Log in</a> <?php
            }
            ?>
        </div>
    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-8">
            <h4>Producten</h4>
        </div>
        <div class="col-md-4 text-right">
            <form method="get">
                <div class="input-group md-form form-sm form-2 pl-0">
                    <input name="search" class="form-control my-0 py-1 amber-border" type="text" placeholder="Zoek producten" aria-label="Search" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-12">
            <?php
            Utility::showCategoryButtons();
            ?>
        </div>
    </div>
    <div class="row">
        <?php
        if (isset($_GET['category']) && (!empty($_GET['category']))) {
            // Only category filter.
            Products::displayProducts(Products::fetchProducts($_GET['category']));
        } elseif (isset($_GET['search']) && (!empty($_GET['search']))) {
            // Only search filter.
            Products::displayProducts(Products::fetchProducts(null, $_GET['search']));
        } elseif (isset($_GET['category']) && (!empty($_GET['category'])) && (isset($_GET['search']) && (!empty($_GET['search'])))) {
            // Both category and search filter.
            Products::displayProducts(Products::fetchProducts($_GET['category'], $_GET['search']));
            }
        else {
            // No filter.
            Products::displayProducts(Products::fetchProducts());
        }
        ?>
    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-12">
            <h4>Winkelmand</h4>
        </div>
    </div>
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-12">
            <?php
            // Add item.
            if (isset($_GET['add_product_id'], $_GET['add_product_name'], $_GET['add_product_price'], $_GET['add_product_quantity'])) {
                Cart::addItem($_GET['add_product_id'], $_GET['add_product_name'], $_GET['add_product_price'], $_GET['add_product_quantity']);
            }

            // Edit item quantity.
            if (isset($_GET['edit_quantity_product_id']) && $_GET['edit_product_quantity']) {
                Cart::editQuantity($_GET['edit_quantity_product_id'], $_GET['edit_product_quantity']);
            }

            // Remove item.
            if (isset($_GET['remove_product_id'])) {
                Cart::removeItem($_GET['remove_product_id']);
            }

            // Empty cart.
            if (isset($_GET['empty_cart'])) {
                Cart::emptyCart();
            }

            Cart::display();
            ?>
        </div>
    </div>
</body>
</html>