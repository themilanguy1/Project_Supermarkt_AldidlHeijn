<?php
require_once('Classes/Autoloader.php');
Session::SessionStart();

// Empty cart.
ShoppingCart::EmptyCart();