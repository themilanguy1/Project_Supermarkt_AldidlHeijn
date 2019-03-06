<?php

/**
 * Class User
 */
class User
{
    /**
     * @param $email
     *  Login email.
     * @param $pass
     *  Login password.
     *
     * Checks input data at login screen against user table, sets session username variable and/or admin status variable.
     */
    public static function Login($email, $pass)
    {
        if (!empty($email) && !empty($pass)) {
            $conn = Database::PDOConnect();

            $admin_check_query = $conn->prepare("select * from gebruikers where gebruiker_email=? and gebruiker_admin_status = 1");
            $admin_check_query->bindParam(1, $email);
            $admin_check_query->execute();

            if ($admin_check_query->rowCount() == 1) {
                $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_email = '$email'";
                $stmt = $conn->prepare($sql_pass);
                $stmt->execute();
                $row = $stmt->fetch();

                if (self::VerifyEncryptedPassword($pass, $row['gebruiker_wachtwoord'])) {
                    $_SESSION['login_user'] = $email;
                    $_SESSION['login_admin_status'] = 1;
                    $_SESSION['login_status'] = 1;
                    header('Location: Home.php');
                } else {
                    echo "Verkeerde email en/of wachtwoord.";
                }
            } else {
                $db_query = $conn->prepare("select * from gebruikers where gebruiker_email=?");
                $db_query->bindParam(1, $email);
                $db_query->execute();

                if ($db_query->rowCount() == 1) {
                    $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_email = '$email'";
                    $stmt = $conn->prepare($sql_pass);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if (self::VerifyEncryptedPassword($pass, $row['gebruiker_wachtwoord'])) {
                        $_SESSION['login_user'] = $email;
                        $_SESSION['login_status'] = 1;
                        header('Location: Home.php');
                    } else {
                        echo "Verkeerde email en/of wachtwoord.";
                    }
                } else {
                    echo "Verkeerde email en/of wachtwoord.";
                }
            }
        } else {
            echo "login informatie mist.";
        }
    }

    /**
     * @param $email
     *  register email.
     * @param $pass
     *  register password.
     *
     * Registers new user in database.
     */
    public static function Register($email, $pass)
    {
        if (!empty($email) && !empty($pass)) {
            $conn = Database::PDOConnect();

            $sql_id = "SELECT MAX(gebruiker_id) FROM gebruikers";
            $stmt = $conn->prepare($sql_id);
            $stmt->execute();
            $row = $stmt->fetch();
            $new_id = $row['MAX(gebruiker_id)'] + 1;

            $admin_status = 0;
            $hashed_pass = self::EncryptPassword($pass);

            $sql = "INSERT INTO gebruikers (gebruiker_id, gebruiker_email,gebruiker_wachtwoord, gebruiker_admin_status) VALUES  (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_id, $email, $hashed_pass, $admin_status]);
            header('Location: Home.php');
        } else {
            echo "login informatie mist.";

        }
    }

    /**
     * Logs user out and redirects to Home.php .
     */
    public static function LogOut()
    {
        session_start();
        if (User::LoginStatus()) {
            session_destroy();
            header('Location: Home.php');
        } else {
            header('Location: Home.php');
        }
    }

    /**
     * @return bool
     *
     * Checks login status.
     */
    public static function LoginStatus()
    {
        if(isset($_POST['login_status'])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @return bool
     *
     * Checks admin status.
     *
     */
    public static function AdminStatus()
    {
        if (isset($_SESSION['login_admin_status'])) {
            if ($_SESSION['login_admin_status']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $pass
     * @return mixed
     *
     * Encrypts passwords.
     */
    public static function EncryptPassword($pass)
    {
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        return $hashed_pass;
    }

    /**
     * @param $pass
     * @return mixed
     *
     * Verifies encrypted passwords.
     */
    protected function VerifyEncryptedPassword($pass, $hashed_pass)
    {
        if (password_verify($pass, $hashed_pass)) {
            return true;
        } else {
            return false;
        }
    }
}