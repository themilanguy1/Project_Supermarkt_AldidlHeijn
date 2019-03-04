<?php

/**
 * Class Database
 */
class Database
{
    /**
     * Connects to database using PDO
     */
    public static function PDOConnect() {
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=aldidlheijn", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Fetches items from DataBase.
     */
    public static function FetchProducts() {
        session_start();

        $conn = self::PDOConnect();
        $result = $conn->query('SELECT * FROM producten')->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $row) {
            ?>
            <div class='col-md-4'>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top align-self-center" src=" <?php echo $row['product_afbeelding'] ?> " style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['product_naam']?> </h5>
                        <p class="card-text"> <?php echo $row['product_prijs']?> </p>
                        <a href="#" class="btn btn-primary">Go Fuck Yourself, Thank You.</a>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    /**
     * @param $email
     *  login email
     * @param $pass
     *  login password
     */
    public static function Login($email, $pass) {
        session_start();
        if(!empty($email) && !empty($pass)){
            $conn = self::PDOConnect();
            $dbquery = $conn->prepare("select * from gebruikers where gebruiker_email=? and gebruiker_wachtwoord=?");
            $dbquery->bindParam(1, $email);
            $dbquery->bindParam(2, $pass);
            $dbquery->execute();

            if($dbquery->rowCount() == 1){
                echo "User verified, Access granted.";
                $_SESSION['login_user'] = $email;
                header('Location: Home.php');
            }else{
                echo "Incorrect username or password";
            }
        }else{
            echo "Login data is missing. Please enter username and password";
        }
    }

    /**
     * Checks login status
     */
    public static function LoginStatus() {
        session_start();
        if(isset($_SESSION['login_user'])) {
            return true;
        } else {
            return false;
        }
    }
}