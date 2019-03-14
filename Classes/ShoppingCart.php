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
            echo "<th scope='col'><a href='EmptyShoppingCart.php'>Empty cart</a></th>";
            echo "</tr>";
            echo "<tbody>";
            foreach ($_SESSION['shopping_cart_inventory'] as $item) {
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    foreach ($item as $key => $value) {
//                        echo "<td>" .$value['product_id'] ."</td>";
//                        echo "<td>" .$value['product_quantity'] ."</td>";
//                        echo "<td><a href='RemoveFromShoppingCart.php?remove_product_id=" . $value['product_id'] . "'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Winkelmand leeg.";
        }
    }

    /**
     * @param $product_id
     *  string Product id of product being added.
     * @param $product_quantity
     *  int Quantity of product being added.
     *
     *  Adds product if new to shopping cart, updates quantity if known.
     */
    public static function Add($product_id, $product_quantity)
    {
        function checkCartForItem($cart_product_id, $cart_items)
        {
            if (is_array($cart_items)) {
                foreach ($cart_items as $key => $item) {
                    if ($item['product_id'] === $cart_product_id)
                        return $key;
                }
            }
            return false;
        }

        if (!isset($_SESSION['shopping_cart_inventory'])) {
            $_SESSION['shopping_cart_inventory'] = array();
        }
        if (!empty($product_id && $product_quantity)) {
            $new_item = array(
                'product_id' => $product_id,
                'product_quantity' => $product_quantity
            );

            $cart_product_id = $new_item['product_id'];
            $itemExists = checkCartForItem($cart_product_id, $_SESSION['shopping_cart_inventory']);

            if ($itemExists !== false) {
                // item exists - increment quantity value by 1
                $_SESSION['shopping_cart_inventory'][$itemExists]['product_quantity'] = $product_quantity + $_SESSION['shopping_cart_inventory'][$itemExists]['product_quantity'];
            } else {
                $_SESSION['shopping_cart_inventory'][] = $new_item;
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            die;
        }
    }

    /**
     * @param $product_id
     *
     *  Removes item from cart according to paramater: $product_id.
     */
    public static function Remove($product_id)
    {
        if (!(empty($product_id)) && isset($_SESSION['shopping_cart_inventory'])) {
            unset($_SESSION['shopping_cart_inventory'][$product_id]);
        }
    }

    /**
     * Empties shopping cart.
     */
    public static function EmptyCart()
    {
        if (isset($_SESSION['shopping_cart_inventory'])) {
            unset($_SESSION['shopping_cart_inventory']);
        }
        header('Location: Home.php');
        die;
    }


    public static function EditQuantity()
    {
        //placeholder
    }


}