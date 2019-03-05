<?php
require_once('Database.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card-body">
                    <h5 class="card-title text-center">Log hier in</h5>
                    <form class="form-signin" method="POST">
                        <div class="from-label-group">
                            <input name="login_email" type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                            <label for="inputEmail"></label>
                        </div>

                        <div class="form-label-group">
                            <input name="login_wachtwoord" type="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>
                            <label for="inputPassword"></label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Aanmelden</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['login_email']) & isset($_POST['login_wachtwoord'])) {
        User::Login($_POST['login_email'], $_POST['login_wachtwoord']);
    }
    ?>
</body>
</html>