<?php
	require_once('classes/Autoloader.php');
	Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="home.php" class="btn btn-primary">Home</a>
        </div>
        <div class="col-md-8">

        </div>
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card-body">
                <h5 class="card-title text-center">Log hier in</h5>
                <form class="form-signin" method="POST">
                    <div class="from-label-group">
                        <input name="login_username" type="text" id="inputUsername" class="form-control"
                               placeholder="gebruikersnaam" required autofocus>
                        <label for="inputEmail"></label>
                    </div>

                    <div class="form-label-group">
                        <input name="login_password" type="password" id="inputPassword" class="form-control"
                               placeholder="Wachtwoord" required>
                        <label for="inputPassword"></label>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Aanmelden</button>
                    <br>
                    <a href="register.php" class="btn btn-lg btn-primary btn-block">Registreren</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
	if (isset($_POST['login_username'], $_POST['login_password'])) {
		$user = new User($_POST['login_username'], $_POST['login_password']);
		$user->login();
		if ($user->login()) {
			header('Location: home.php');
		} else {
			echo "<h4>Gebruikersnaam of wachtwoord is onjuist.</h4>";
		}
	}
?>
</body>
</html>