<?php
require_once('Classes/Autoloader.php');
Session::SessionStart();

// Remove item.
if (isset($_GET['remove_product_id'])) {
    ShoppingCart::Remove($_GET['remove_product_id']);
} else {
    header('Location: Home.php');
    die;
}
