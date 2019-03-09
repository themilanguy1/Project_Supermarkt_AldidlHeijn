<?php

/**
 * Class Session
 */
class Session
{
    /**
     * Starts session if not already started.
     */
    public static function SessionStart()
    {
        session_start();
    }
}