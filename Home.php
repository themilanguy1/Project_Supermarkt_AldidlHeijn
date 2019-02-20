<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="Main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 auto-center">
                <h3>hallo</h3>
                <a href="Login.php" class="btn btn-primary">Log Hier In, Sukkeltje ;)</a>
            </div>
            <div class="col-md-12">
                <br>
                <h4>Producten</h4>
            </div>
                <?php
                require_once('Database.php');
                foreach (Database::FetchProducts() as $row) {

                ?>
            <div class='col-md-4'>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top align-self-center" src=" <?php echo $row['product_afbeelding'] ?> " style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['product_naam']?> </h5>
                        <p class="card-text"> <?php echo $row['product_prijs']?> </p>
                        <p class="card-text"> <?php echo $row['product_prijs']?> </p>
                        <a href="#" class="btn btn-primary">Go Fuck Yourself, Thank You.</a>
                    </div>
                </div>
            </div>
                <?php
                }
                ?>
        </div>
    </div
</body>
</html>