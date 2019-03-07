<?php

/**
 * Class UserRegister
 */
class UserRegister extends User
{
    /**
     * @var
     *  string Email address.
     */
    protected $email;

    /**
     * UserRegister constructor.
     * @param $input_email
     * @param $input_user
     * @param $input_pass
     */
    public function __construct($input_email, $input_user, $input_pass)
    {
        parent::__construct($input_user, $input_pass);
        $this->email = $input_email;
        $this->Register($this->email, $this->user, $this->pass);
    }


    /**
     * @param $email
     *  register email.
     * @param $pass
     *  register password.
     *
     * Registers new user in database.
     */
    protected function Register($email, $user, $pass)
    {
        if (!empty($email) && !empty($pass)) {
            $conn = Database::PDOConnect();

            $sql_id = "SELECT MAX(gebruiker_id) FROM gebruikers";
            $stmt = $conn->prepare($sql_id);
            $stmt->execute();
            $row = $stmt->fetch();
            $new_id = $row['MAX(gebruiker_id)'] + 1;

            $admin_status = 0;
            $hashed_pass = User::EncryptPassword($pass);

            $sql = "INSERT INTO gebruikers (gebruiker_id, gebruiker_email, gebruiker_gebruikersnaam, gebruiker_wachtwoord, gebruiker_admin_status) VALUES  (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_id, $email, $user, $hashed_pass, $admin_status]);
            header('Location: Home.php');
        } else {
            echo "login informatie mist.";
        }
    }
}