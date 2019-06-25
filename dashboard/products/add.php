<?php
include_once('../../classes/Autoloader.php');
Session::start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../style/dashboard.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
</head>
<body>
<div class="container">
    <div class="row" style="margin-top:0.5em;">
        <div class="col-md-8">
            <h2>Producten toevoegen</h2>
        </div>
        <div class="col-md-4 text-right">
            <?php
            if (Session::loginStatus()) {
                if (Session::adminStatus()) {
                    ?> <a href="../../home.php" class="btn btn-primary">Home</a> <?php
                } else {
                    header('Location: Home.php');
                    die;
                }
                ?> <a href="../../logout.php" class="btn btn-primary">Log uit</a> <?php
            } else {
                header('Location: Home.php');
                die;
            }
            ?>
        </div>
        <div class="col-md-12" style="margin-top:2em;">
            <form method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Naam: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_naam" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Categorie: </label>
                        <div class="col-sm-10">
                            <?php
                            Utility::selectCategory();
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Afbeelding link: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_afbeelding" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Prijs: </label>
                        <div class="col-sm-10">
                            <input type="number" min="0" step="any" class="form-control" name="product_prijs" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" name="submit" class="btn btn-primary">Toevoegen</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                if(isset($_POST['product_naam'])) {
                    Products::addProduct(Utility::getNewId("producten", "product_id"),
                        $_POST['product_naam'], $_POST['product_categorie'], $_POST['product_afbeelding'],
                        $_POST['product_prijs']);
                }
            ?>
        </div>
    </div>
</div
</body>
</html>
