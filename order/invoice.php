<?php
	require_once('../classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bestellen</title>
    <link rel="stylesheet" href="../Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-6">
            <h2>Bestellen</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="../home.php" class="btn btn-primary">Home</a>
			<?php
				if (Session::loginStatus()) {
					if (Session::adminStatus()) {
						?> <a href="../admin_dashboard.php" class="btn btn-primary">Admin Dashboard</a> <?php
					} else {
						?> <a href="../user_dashboard.php" class="btn btn-primary">Gebruiker Dashboard</a> <?php
					}
					?> <a href="../logout.php" class="btn btn-primary">Log uit</a> <?php
				} else {
					?> <a href="../loginpage.php" class="btn btn-primary">Log in</a> <?php
				}
			?>
        </div>
        <div class="col-md-8">
            <h4>Factuur</h4>
        </div>
        <div class="col-md-12">
			<?php
			    if (Order::displayInvoice($_SESSION['shopping_cart_inventory'])) {
			        echo "<a class='btn btn-primary' href='delivery_options.php'> > Verder naar bestellen</a>";
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>