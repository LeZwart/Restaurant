<?php
session_start();

if (!isset($_SESSION["ID"])) {
    header("Location: index.php");
    exit();
}

session_destroy();
header("Location: index.php");

?>