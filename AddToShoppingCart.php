<?php
require_once('Classes/Autoloader.php');
Session::SessionStart();
if (isset($_GET['add_product_id']) & isset($_GET['add_product_quantity'])) {
    ShoppingCart::Add($_GET['add_product_id'], $_GET['add_product_quantity']);
    ShoppingCart::DisplayInventory();
} else {
    header('Location: Home.php');
}