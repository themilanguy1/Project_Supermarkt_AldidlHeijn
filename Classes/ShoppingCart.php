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
            ?>
            <table class='table' style='margin:0.5em;'>
                <thead class='thead-dark'>
                <tr>
                    <th scope='col'>Product</th>
                    <th scope='col'>Prijs</th>
                    <th scope='col'>Aantal</th>
                    <th scope='col'><a href='EmptyShoppingCart.php'><i class=\"far fa-trash-alt\"></i> Alles</a></th>
                </tr>
                <tbody>
                <?php
                $total_price = 0;
                foreach ($_SESSION['shopping_cart_inventory'] as $item) {
                    $total_price = ($total_price + ($item['product_price'] * $item['product_quantity']));
                    echo "<tr>";
                    if (is_array($item) || is_object($item)) {
                        echo "<td>" . $item['product_name'] . "</td>";
                        echo "<td> € " . number_format($val = ($item['product_price'] * $item['product_quantity']), 2) . "</td>";
                        ?>
                        <td>
                            <form method="GET" action="EditQuantityShoppingCart.php">
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="hidden" name="edit_quantity_product_id"
                                               value="<?php echo $item['product_id'] ?>">
                                        <input class="form-control" style="max-width:4.5em;" type="number" min="1"
                                               name="edit_product_quantity"
                                               value="<?php echo $item['product_quantity'] ?>"required>
                                    </div>
                                    <div class=" form-group text-right">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-sync"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <?php
                        echo "<td><a href='RemoveFromShoppingCart.php?remove_product_id=" . $item['product_id'] . "'><i style='color: black;' class=\"far fa-trash-alt\"></i></a></td>";
                    }
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td><b>Totaal: </b></td>
                    <td><b>€ <?php echo $total_price ?> </b></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <?php
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
     * @param $product_id
     *  int Product id.
     *
     *  Removes item from cart.
     */
    public static function Remove($product_id)
    {
        if (!(empty($product_id)) && isset($_SESSION['shopping_cart_inventory'])) {
            $itemExists = self::checkCartForItem($product_id, $_SESSION['shopping_cart_inventory']);

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

    /**
     * @param $product_id
     *  int Product id.
     * @param $new_product_quantity
     *  int New product quantity.
     *
     *  Edits quantity of item in cart.
     */
    public static function EditQuantity($product_id, $new_product_quantity)
    {
        if (!(empty($product_id)) && isset($_SESSION['shopping_cart_inventory'])) {
            $itemExists = self::checkCartForItem($product_id, $_SESSION['shopping_cart_inventory']);

            if ($itemExists !== false) {
                $_SESSION['shopping_cart_inventory'][$itemExists]['product_quantity'] = $new_product_quantity;
            }
        }
        header('Location: Home.php');
        die;
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