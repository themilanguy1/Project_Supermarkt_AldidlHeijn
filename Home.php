<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="Main.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 auto-center">
                <h3>hallo</h3>
            </div>
            <div class="col-md-12">
                <br>
                <h4>Producten</h4>
            </div>
                <?php
                require_once('Database.php');
                foreach (Database::FetchProducts() as $row) {
                    echo "<div class='col-md-4'>";
                    echo "<div class='productdoos'>";
                    echo "product: ".$row['naam_product'];
                    echo "<br />";
                    echo "prijs: ".$row['prijs'];
                    $afbeelding = $row['afbeelding'];

                    echo "<img src='$afbeelding'/>";
                    echo "</div>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div
</body>
</html>