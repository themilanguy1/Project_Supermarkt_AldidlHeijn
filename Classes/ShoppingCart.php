<?php

/**
 * Class ShoppingCart
 */
class ShoppingCart
{
    /**
     * @return bool
     *  Displays shopping cart inventory.
     */
    public static function DisplayInventory()
    {
        if (isset($_SESSION['shopping_cart_inventory']) && (!empty($_SESSION['shopping_cart_inventory']))) {
            foreach ($_SESSION['shopping_cart_inventory'] as $item) {
                if (is_array($item) || is_object($item)) {
                    foreach ($item as  $key => $value) {
                        echo $key . " " . $value;
                        echo "<br />";
                    }
                }
            }
            return true;
        } else {
            echo "Winkelmand leeg.";
            return false;
        }
    }

    /**
     * @param $product_id
     *  string Product id of product being added.
     * @param $product_quantity
     *  int Quantity of product being added.
     */
    public static function Add($product_id, $product_quantity)
    {
        if (!empty($product_id && $product_quantity)) {
            if (isset($_SESSION['shopping_cart_inventory']) && (!empty($_SESSION['shopping_cart_inventory']))) {
                // check if product being added to cart already exists in cart ->
                if (array_search($product_id, array_column($_SESSION['shopping_cart_inventory'], 'product_id'))) {
//                    $_SESSION['shopping_cart_inventory']['product_quantity'] = $product_quantity;
                } else {
                    $_SESSION['shopping_cart_inventory'][] = array(
                        "product_id" => $product_id, "product_quantity" => $product_quantity
                    );
                }
            } else {
                $_SESSION['shopping_cart_inventory'] = array(
                    "product_id" => $product_id, "product_quantity" => $product_quantity
                );
            }
        }
        header('Location: Home.php');
    }


    public static function Remove()
    {

    }


    public static function EditQuantity()
    {

    }
}