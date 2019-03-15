<?php
require_once('Classes/Autoloader.php');
Session::SessionStart();

// Add item.
if (isset($_GET['add_product_id'], $_GET['add_product_name'], $_GET['add_product_price'], $_GET['add_product_quantity'])) {
    ShoppingCart::Add($_GET['add_product_id'], $_GET['add_product_name'] , $_GET['add_product_price'],$_GET['add_product_quantity']);
} else {
    header('Location: Home.php');
    die;
}

