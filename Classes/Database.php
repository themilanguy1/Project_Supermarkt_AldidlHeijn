<?php

/**
 * Class Database
 */
class Database
{
    /**
     * @param string $servername
     * @param string $username
     * @param null $password
     * @return PDO
     *
     * Connects to SQL database using PDO.
     */
    public static function PDOConnect($servername = "localhost", $username = "root", $password = NULL)
    {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=aldidlheijn", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Fetches items from DataBase.
     */
    public static function FetchProducts()
    {
        $conn = self::PDOConnect();
        $result = $conn->query('SELECT * FROM producten, categorie WHERE producten.categorie_id = categorie.categorie_id')->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            ?>
            <div class='col-md-4' xmlns="http://www.w3.org/1999/html">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top align-self-center" alt="<?php $row['product_naam'] ?>"
                         src=" <?php echo $row['product_afbeelding'] ?> "
                         style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['product_naam'] ?> </h5>
                        <p class="card-title"> <?php echo "Categorie: " . $row['categorie_naam'] ?> </p>
                        <p class="card-text">€ <?php echo $row['product_prijs'] ?> </p>
                        <form method="GET" action="AddToShoppingCart.php">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <input type="hidden" name="add_product_id" value="<?php echo $row['product_id'] ?>">
                                    <input class="form-control" type="number" min="1" max="999"
                                           name="add_product_quantity" value="1" required>
                                </div>
                                <div class="form group col-md-3">

                                </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" class="btn btn-primary">Voeg toe <i
                                                class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}