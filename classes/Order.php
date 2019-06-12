<?php
	
	/**
	 * Class Order
	 */
	class Order
	{
		/**
		 * @param $data
		 *
		 *  Displays order.
		 */
		public static function displayInvoice($data)
		{
			if (!is_null($data)) {
				?>
                <table class='table'>
                    <thead class='thead-dark'>
                    <tr>
                        <th scope='col'>Product</th>
                        <th scope='col'>Prijs</th>
                        <th scope='col'>Aantal</th>
                        <th scope='col'>Subtotaal</th>
                    </tr>
                    <tbody>
					<?php
						$total = 0;
						$sub_total = 0;
						foreach ($_SESSION['shopping_cart_inventory'] as $item) {
							$total = ($total + ($item['product_price'] * $item['product_quantity']));
							$sub_total = $item['product_price'] + $item['product_quantity'];
							echo "<tr>";
							if (is_array($item) || is_object($item)) {
								echo "<td>" . $item['product_name'] . "</td>";
								echo "<td>" . $item['product_price'] . "</td>";
								echo "<td>" . $item['product_quantity'] . "</td>";
								echo "<td> € " . number_format($val = ($item['product_price'] * $item['product_quantity']), 2) . "</td>";
								
								?>
								<?php
							}
							echo "</tr>";
						}
					?>
                    <tr>
                        <td><b>Totaal: </b></td>
                        <td></td>
                        <td></td>
                        <td><b>€ <?php echo $total ?> </b></td>
                    </tr>
                    </tbody>
                </table>
				<?php
                return true;
			} else {
				echo "Winkelmand leeg.";
				return false;
			}
		}
	}