<?php

/**
 * Class UserLogin
 */
class UserLogin extends User
{
    /**
     * UserLogin constructor.
     * @param $input_user
     * @param $input_pass
     */
    public function __construct($input_user, $input_pass)
    {
        parent::__construct($input_user, $input_pass);
        $this->Login($this->user, $this->pass);
    }

    /**
     * @param $user
     *  Login email.
     * @param $pass
     *  Login password.
     *
     * Checks input data at login screen against user table, sets session username variable and/or admin status variable.
     */
    public function Login($user, $pass)
    {
        if (!empty($user) && !empty($pass)) {
            $conn = Database::PDOConnect();

            $admin_check_query = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=? and gebruiker_admin_status = 1");
            $admin_check_query->bindParam(1, $user);
            $admin_check_query->execute();

            if ($admin_check_query->rowCount() == 1) {
                $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_gebruikersnaam = '$user'";
                $stmt = $conn->prepare($sql_pass);
                $stmt->execute();
                $row = $stmt->fetch();

                if (self::VerifyEncryptedPassword($pass, $row['gebruiker_wachtwoord'])) {
                    $_SESSION['login_user'] = $user;
                    $_SESSION['login_admin_status'] = true;
                    $_SESSION['login_status'] = true;
                    header('Location: Home.php');
                } else {
                    echo "Onjuiste inlog informatie";
                }
            } else {
                $db_query = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=?");
                $db_query->bindParam(1, $user);
                $db_query->execute();

                if ($db_query->rowCount() == 1) {
                    $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_gebruikersnaam = '$user'";
                    $stmt = $conn->prepare($sql_pass);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if (self::VerifyEncryptedPassword($pass, $row['gebruiker_wachtwoord'])) {
                        $_SESSION['login_user'] = $user;
                        $_SESSION['login_status'] = true;
                        header('Location: Home.php');
                    } else {
                        echo "Onjuiste inlog informatie";
                    }
                } else {
                    echo "Onjuiste inlog informatie";
                }
            }
        } else {
            echo "login informatie mist.";
        }
    }

}