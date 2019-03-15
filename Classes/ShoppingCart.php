<?php

/**
 * Class ShoppingCart
 */
class ShoppingCart
{
    /**
     * Displays shopping cart inventory.
     */
    public static function DisplayInventory()
    {
        if (isset($_SESSION['shopping_cart_inventory']) && (!empty($_SESSION['shopping_cart_inventory']))) {
            echo "<div class='col-md-6'>";
            echo "<table class='table'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th scope='col'>Product</th>";
            echo "<th scope='col'>Prijs</th>";
            echo "<th scope='col'>Aantal</th>";
            echo "<th scope='col'><a href='EmptyShoppingCart.php'>Empty</a></th>";
            echo "</tr>";
            echo "<tbody>";
            $total_price = 0;
            foreach ($_SESSION['shopping_cart_inventory'] as $item) {
                $total_price = number_format($total_price+($item['product_price']*$item['product_quantity']), 2);
                echo "<tr>";
                if (is_array($item) || is_object($item)) {
                    echo "<td>" . $item['product_name'] . "</td>";
                    echo "<td> € " . number_format($val = ($item['product_price']*$item['product_quantity']), 2) . "</td>";
                    echo "<td>" . $item['product_quantity'] . "</td>";
                    echo "<td><a href='RemoveFromShoppingCart.php?remove_product_id=" . $item['product_id'] . "'><i style='color: black;' class=\"far fa-trash-alt\"></i></a></td>";
                }
                echo "</tr>";
            }
            echo "<tr>";
            echo "<td><b>Totaal: </b></td>";
            echo "<td>€ $total_price</td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "Winkelmand leeg.";
        }
    }

    /**
     * @param $product_id
     *  int Product id.
     * @param $product_name
     *  string Product name.
     * @param $product_price
     *  int Product price.
     * @param $product_quantity
     *  int Quantity of product.
     *
     *  Adds product if new to shopping cart, updates quantity if known.
     */
    public static function Add($product_id, $product_name, $product_price, $product_quantity)
    {
        if (!isset($_SESSION['shopping_cart_inventory'])) {
            $_SESSION['shopping_cart_inventory'] = array();
        }

        if (!empty($product_id && $product_name && $product_price && $product_quantity)) {
            $new_item = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_quantity' => $product_quantity
            );

            $item_exists = self::checkCartForItem($product_id, $_SESSION['shopping_cart_inventory']);

            if ($item_exists !== false) {
                $_SESSION['shopping_cart_inventory'][$item_exists]['product_quantity'] = $product_quantity + $_SESSION['shopping_cart_inventory'][$item_exists]['product_quantity'];
            } else {
                $_SESSION['shopping_cart_inventory'][] = $new_item;
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            die;
        }
    }

    /**
     * @param $remove_product_id
     *  Id by which to remove item from shopping cart.
     *
     *  Removes item from cart according to parameter: $product_id.
     */
    public static function Remove($remove_product_id)
    {
        if (!(empty($remove_product_id)) && isset($_SESSION['shopping_cart_inventory'])) {
            $itemExists = self::checkCartForItem($remove_product_id, $_SESSION['shopping_cart_inventory']);

            if ($itemExists !== false) {
                unset($_SESSION['shopping_cart_inventory'][$itemExists]);
            }
        }
        header('Location: Home.php');
        die;
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


    /**
     * @param $cart_product_id
     *  int Product id of item to check for.
     * @param $cart_items
     *  array List of arrays with items.
     * @return bool|int|string
     *
     *  Checks shopping cart for item according to product_id.
     */
    protected static function checkCartForItem($cart_product_id, $cart_items)
    {
        if (is_array($cart_items)) {
            foreach ($cart_items as $key => $item) {
                if ($item['product_id'] === $cart_product_id)
                    return $key;
            }
        }
        return false;
    }
}