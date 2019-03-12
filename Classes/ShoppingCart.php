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
            echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th scope='col'>Product_id</th>";
            echo "<th scope='col'>Aantal</th>";
            echo "</tr>";
            echo "<tbody>";
            foreach ($_SESSION['shopping_cart_inventory'] as $item) {
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    foreach ($item as $key => $value) {
                        echo "<td>$value</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
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
                if (array_search($product_id, array_column($_SESSION['shopping_cart_inventory'], 'product_id'))) {
                    echo "yeet";
                }
                else {
                    $_SESSION['shopping_cart_inventory'][] = array(
                        "product_id" => $product_id,
                        "product_quantity" => $product_quantity
                    );
                }
            } else {
                $_SESSION['shopping_cart_inventory'] = array(
                    array(
                        "product_id" => $product_id,
                        "product_quantity" => $product_quantity
                    )
                );
            }
        }
        header('Location: Home.php');
    }


    public static function Remove()
    {
        //placeholder

    }


    public static function EditQuantity()
    {
        //placeholder
    }
}