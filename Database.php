<?php

/**
 * Class Database
 */
class Database
{
    /**
     * Connects to database using PDO
     */
    public static function PDOConnect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

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
        $result = $conn->query('SELECT * FROM producten')->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            ?>
            <div class='col-md-4'>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top align-self-center" src=" <?php echo $row['product_afbeelding'] ?> "
                         style="width:150px;height:150px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?php echo $row['product_naam'] ?> </h5>
                        <p class="card-text"> <?php echo $row['product_prijs'] ?> </p>
                        <a href="#" class="btn btn-primary">Stik in je speeksel, makker.</a>
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
     *
     * Checks input data at login screen against user table, sets session username variable and/or admin status variable.
     */
    public static function Login($email, $pass)
    {
        if (!empty($email) && !empty($pass)) {
            $conn = self::PDOConnect();

            $admin_check_query = $conn->prepare("select * from gebruikers where gebruiker_email=? and gebruiker_wachtwoord=? and gebruiker_admin_status = 1");
            $admin_check_query->bindParam(1, $email);
            $admin_check_query->bindParam(2, $pass);
            $admin_check_query->execute();

            if ($admin_check_query->rowCount() == 1) {
                $_SESSION['login_user'] = $email;
                $_SESSION['login_admin_status'] = 1;
                header('Location: Home.php');
            } else {
                $db_query = $conn->prepare("select * from gebruikers where gebruiker_email=? and gebruiker_wachtwoord=?");
                $db_query->bindParam(1, $email);
                $db_query->bindParam(2, $pass);
                $db_query->execute();

                if ($db_query->rowCount() == 1) {
                    $_SESSION['login_user'] = $email;
                    header('Location: Home.php');
                } else {
                    echo "Verkeerde email en/of wachtwoord.";
                }
            }
        } else {
            echo "login informatie mist.";
        }
    }

    /**
     * @return bool
     *
     * Checks login status.
     */
    public static function LoginStatus()
    {
        if (isset($_SESSION['login_user'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     *
     * Checks admin status.
     *
     */
    public static function AdminStatus() {
        if (isset($_SESSION['login_admin_status'])) {
            if($_SESSION['login_admin_status'] = 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}