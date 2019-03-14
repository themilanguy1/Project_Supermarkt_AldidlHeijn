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
    protected $user;

    /**
     * @var
     *  string Password.
     */
    protected $pass;

    /**
     * User constructor.
     * @param $input_user
     * @param $input_pass
     */
    public function __construct($input_user, $input_pass)
    {
        $this->user = $input_user;
        $this->pass = $input_pass;
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
            die;
        } else {
            header('Location: Home.php');
            die;
        }
    }

    /**
     * @return bool
     *
     * Checks login status.
     */
    public static function LoginStatus()
    {
        if (isset($_SESSION['login_status']) && $_SESSION['login_status'] == true) {
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
        if (isset($_SESSION['login_admin_status']) && $_SESSION['login_admin_status'] == true) {
            return true;
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
     * @param $hashed_pass
     * @return bool
     *
     * Verifies encrypted passwords.
     */
    protected static function VerifyEncryptedPassword($pass, $hashed_pass)
    {
        if (password_verify($pass, $hashed_pass)) {
            return true;
        } else {
            return false;
        }
    }
}