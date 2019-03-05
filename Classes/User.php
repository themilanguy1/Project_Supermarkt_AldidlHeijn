<?php

/**
 * Class User
 */
class User
{
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
            $conn = Database::PDOConnect();

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

            $sql = "INSERT INTO gebruikers (gebruiker_id, gebruiker_email,gebruiker_wachtwoord, gebruiker_admin_status) VALUES  (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_id, $email, $pass, $admin_status]);
        } else {
            echo "Logging data is missing. Please enter username and password";

        }
    }

    /**
     * Log user out and redirects to Home.php .
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
    public static function AdminStatus()
    {
        if (isset($_SESSION['login_admin_status'])) {
            if ($_SESSION['login_admin_status'] = 1) {
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
    protected function EncryptPassword($pass)
    {
        return $encrypted_password;
    }

    /**
     * @param $pass
     * @return mixed
     *
     * Unencrypts passwords.
     */
    protected function UnEncryptPassword($pass)
    {
        return $unencrypted_password;
    }
}