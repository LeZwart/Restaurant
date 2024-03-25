<?php
session_start();
require 'database.php';

if (!isset($_SESSION["ID"])) {
    header("Location: index.php");
    exit();
}

$


