<?php
	require_once('../classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-8">
            <h2>Gebruiker dashboard</h2>
        </div>
        <div class="col-md-4 text-right">
			<?php
				if (Session::loginStatus()) {
					?> <a href="../home.php" class="btn btn-primary">Home</a>
                    <a href="../logout.php" class="btn btn-primary">Log uit</a> <?php
				} else {
					header('Location: home.php');
					die;
				}
			?>
        </div>
    </div>
</div
</body>
</html>