<?php
require_once('Classes/Database.php');
require_once('Classes/User.php');
session_start();
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
                <a href="Login.php" class="btn btn-primary">Log in</a>
                <a href="Home.php" class="btn btn-primary">Home</a>
            </div>
            <div class="col-md-8">

            </div>
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card-body">
                    <h5 class="card-title text-center">Maak een nieuwe account aan</h5>
                    <form class="form-signin" method="POST">
                        <div class="from-label-group">
                            <input name="registreer_email" type="email" id="inputEmail" class="form-control" placeholder="Vul uw email adres in" required autofocus>
                            <label for="inputEmail"></label>
                        </div>

                        <div class="form-label-group">
                            <input name="registreer_wachtwoord" type="password" id="inputPassword" class="form-control" placeholder="Kies een wachtwoord" required>
                            <label for="inputPassword"></label>
                        </div>

                        <div class="form-label-group">
                            <input name="registreer_wachtwoord_check" type="password" id="inputPassword" class="form-control" placeholder="Wachtwoord herhalen" required>
                            <label for="inputPassword"></label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Account aanmaken</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['registreer_email']) & isset($_POST['registreer_wachtwoord']) & isset($_POST['registreer_wachtwoord_check'])) {
        if($_POST['registreer_wachtwoord'] == $_POST['registreer_wachtwoord_check']) {
            User::Register($_POST['registreer_email'], $_POST['registreer_wachtwoord']);
        } else {
            echo "Uw ingevulde wachtwoorden komen niet overeen.";
        }
    }
    ?>
</body>
</html>