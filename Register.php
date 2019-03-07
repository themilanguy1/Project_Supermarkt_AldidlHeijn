<?php
require_once('Classes/Autoloader.php');
Autoloader::LoadClasses();
Autoloader::SessionStart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registreren</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php
                if (User::LoginStatus()) {
                    ?> <a href="Logout.php" class="btn btn-primary">Log uit</a> <?php
                } else {
                    ?> <a href="Login.php" class="btn btn-primary">Log in</a> <?php
                }
                ?>
                <a href="Home.php" class="btn btn-primary">Home</a>
            </div>
            <div class="col-md-8">

            </div>
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card-body">
                    <h5 class="card-title text-center">Maak een nieuwe account aan</h5>
                    <form class="form-signin" method="POST">
                        <div class="from-label-group">
                            <input name="register_email" type="email" id="inputEmail" class="form-control" placeholder="Vul uw email adres in" required autofocus>
                            <label for="inputEmail"></label>
                        </div>

                        <div class="from-label-group">
                            <input name="register_username" type="text" id="inputUsername" class="form-control" placeholder="Vul uw gebruikersnaam in" required autofocus>
                            <label for="inputEmail"></label>
                        </div>

                        <div class="form-label-group">
                            <input name="register_password" type="password" id="inputPassword" class="form-control" placeholder="Kies een wachtwoord" required>
                            <label for="inputPassword"></label>
                        </div>

                        <div class="form-label-group">
                            <input name="register_password_check" type="password" id="inputPassword" class="form-control" placeholder="Wachtwoord herhalen" required>
                            <label for="inputPassword"></label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Account aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['register_email']) & isset($_POST['register_username']) & isset($_POST['register_password']) & isset($_POST['register_password_check'])) {
        if($_POST['register_password'] == $_POST['register_password_check']) {
            $user_registration =  new UserRegister($_POST['register_email'], $_POST['register_username'], $_POST['register_password']);
        } else {
            echo "Uw ingevulde wachtwoorden komen niet overeen.";
        }
    }
    ?>
</body>
</html>