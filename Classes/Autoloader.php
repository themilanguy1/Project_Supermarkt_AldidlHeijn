<?php

/**
 * Class Autoloader
 */
class Autoloader
{
    /**
     * Loads required PHP classes.
     */
    public static function LoadClasses()
    {
        require_once('Database.php');
        require_once('User.php');
        require_once('UserLogin.php');
        require_once('UserRegister.php');
    }

    /**
     * Starts session if not already started.
     */
    public static function SessionStart()
    {
        session_start();
    }
}