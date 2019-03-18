<?php

/**
 * Class User
 */
class User
{
    /**
     * @var
     * string Username.
     */
    protected $user_name;

    /**
     * @var
     *  string Password.
     */
    protected $pass;

    /**
     * @var
     *  string Email address.
     */
    protected $email;

    /**
     * User constructor.
     * @param $user_name
     * @param $pass
     * @param $email
     */
    public function __construct($user_name, $pass, $email = null)
    {
        $this->user_name = $user_name;
        $this->pass = $pass;
        $this->email = $email;
    }

    /**
     * Checks input data at login screen against user table, sets session username variable and/or admin status variable.
     */
    public function Login()
    {
        if (!empty($this->user_name) && !empty($this->pass)) {
            $conn = Utility::PDOConnect();

            $admin_check_query = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=? and gebruiker_admin_status = 1");
            $admin_check_query->bindParam(1, $this->user_name);
            $admin_check_query->execute();

            if ($admin_check_query->rowCount() == 1) {
                $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_gebruikersnaam = '$this->user_name'";
                $stmt = $conn->prepare($sql_pass);
                $stmt->execute();
                $row = $stmt->fetch();

                if (Utility::VerifyEncryptedPassword($this->pass, $row['gebruiker_wachtwoord'])) {
                    $_SESSION['login_user'] = $this->user_name;
                    $_SESSION['login_admin_status'] = true;
                    $_SESSION['login_status'] = true;
                    header('Location: Home.php');
                    die;
                } else {
                    echo "Onjuiste inlog informatie";
                }
            } else {
                $db_query = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=?");
                $db_query->bindParam(1, $this->user_name);
                $db_query->execute();

                if ($db_query->rowCount() == 1) {
                    $sql_pass = "SELECT gebruiker_wachtwoord FROM gebruikers WHERE gebruiker_gebruikersnaam = '$this->user_name'";
                    $stmt = $conn->prepare($sql_pass);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    if (Utility::VerifyEncryptedPassword($this->pass, $row['gebruiker_wachtwoord'])) {
                        $_SESSION['login_user'] = $this->user_name;
                        $_SESSION['login_status'] = true;
                        header('Location: Home.php');
                        die;
                    }
                }
            }
        }
    }

    /**
     * Registers new user in database.
     */
    public function Register()
    {
        if (!empty($this->email) && !empty($this->user_name) && !empty($this->pass)) {
            $conn = Utility::PDOConnect();
            $new_id = Utility::GetNewUserId();
            $hashed_pass = Utility::EncryptPassword($this->pass);

            $stmt = $conn->prepare("INSERT INTO gebruikers (gebruiker_id, gebruiker_email, gebruiker_gebruikersnaam, gebruiker_wachtwoord, gebruiker_admin_status) VALUES  (?, ?, ?, ?, ?)");
            $stmt->execute([$new_id, $this->email, $this->user_name, $hashed_pass, $admin_status = 0]);
            header('Location: Home.php');
            die;
        } else {
            echo "input parameter mist.";
        }
    }
}