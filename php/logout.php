<?php
session_start(); // Start or resume the session
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_destroy();
header("Location:../index.html");
?>



