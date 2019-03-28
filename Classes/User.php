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
    public function login()
    {

        if (!empty($this->user_name) && !empty($this->pass)) {
            $conn = Utility::pdoConnect();

            $login = $conn->prepare("select * from gebruikers where gebruiker_gebruikersnaam=:user_name");
            $login->bindParam(':user_name', $this->user_name);
            $login->execute();

            if ($login->rowCount() == 1) {
                $user_data = $login->fetch(PDO::FETCH_ASSOC);
                $hashed_pass = $user_data['gebruiker_wachtwoord'];
                $admin_status = $user_data['gebruiker_admin_status'];

                if (Utility::verifyEncryptedPassword($this->pass, $hashed_pass)) {
                    // Password verified, user has been logged in.
                    $_SESSION['login_status'] = true;
                    $_SESSION['login_user'] = $user_data['gebuiker_gebruikersnaam'];

                    if ($admin_status == 1) {
                        // Admin status verified, user has been logged in as admin.
                        $_SESSION['login_admin_status'] = true;

                    } else {
                        $_SESSION['login_admin_status'] = false;
                    }
                    header('Location: Home.php');
                    die;
                } else {
                    echo "<h4>Gebruikersnaam of wachtwoord is onjuist.</h4>";
                }
            } else {
                echo "<h4>Gebruikersnaam of wachtwoord is onjuist.</h4>";
            }
        }
    }

    /**
     * Registers new user in database.
     */
    public function register()
    {
        if (!empty($this->email) && !empty($this->user_name) && !empty($this->pass)) {
            $conn = Utility::pdoConnect();
            $new_id = Utility::getNewUserId();
            $hashed_pass = Utility::encryptPassword($this->pass);
            $register_admin_status = 0;

            $register = $conn->prepare("INSERT INTO gebruikers (gebruiker_id, gebruiker_email, gebruiker_gebruikersnaam, gebruiker_wachtwoord, gebruiker_admin_status) VALUES  (?, ?, ?, ?, ?)");
            $register->bindParam(1, $new_id);
            $register->bindParam(2, $this->email);
            $register->bindParam(3, $this->user_name);
            $register->bindParam(4, $hashed_pass);
            $register->bindParam(5, $register_admin_status);
            $register->execute();

            header('Location: Home.php');
            die;
        } else {
            echo "input parameter mist.";
        }
    }
}