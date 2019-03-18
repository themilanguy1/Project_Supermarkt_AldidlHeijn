<?php

/**
 * Class Session
 */
class Session
{
    /**
     * Starts session if not already started.
     */
    public static function Start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Logs user out and redirects to Home.php .
     */
    public static function LogOut()
    {
        session_start();
        if (self::LoginStatus()) {
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
}