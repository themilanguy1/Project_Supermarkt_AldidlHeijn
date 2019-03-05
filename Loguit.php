<?php
require_once('Database.php');
session_start();
if(Database::LoginStatus()) {
    session_start();
    echo "yeet";
    session_destroy();
    header('Location: Home.php');
} else {
    header('Location: Home.php');
}
