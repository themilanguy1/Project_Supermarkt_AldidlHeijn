<?php
require_once('classes/Autoloader.php');
Session::start();
Session::logOut();
if (Session::logOut()) {
	header("Location: home.php");
}