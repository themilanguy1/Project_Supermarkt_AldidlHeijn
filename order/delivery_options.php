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
            <h4>Bestellen</h4>
        </div>
        <div class="col-md-12">
            <form>
                <?php
                    //TODO maak form kiezen bestellen of afhalen.
                ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary"> > Verder naar betalen</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>