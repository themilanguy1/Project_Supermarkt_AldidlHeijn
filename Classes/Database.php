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
            <div class='col-md-4'>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top align-self-center" alt="<?php $row['product_naam'] ?>" src=" <?php echo $row['product_afbeelding'] ?> "
                         style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['product_naam'] ?> </h5>
                        <h6 class="card-title"> <?php echo "Categorie: " . $row['categorie_naam'] ?> </h6>
                        <p class="card-text">€ <?php echo $row['product_prijs'] ?> </p>
                        <a href="#" class="btn btn-primary">Stik in je speeksel, makker.</a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}