<?php
require_once('Classes/Autoloader.php');
Session::SessionStart();

// Remove item.
if (isset($_GET['edit_quantity_product_id']) && $_GET['edit_product_quantity']) {
    ShoppingCart::EditQuantity($_GET['edit_quantity_product_id'], $_GET['edit_product_quantity']);
} else {
    header('Location: Home.php');
    die;
}