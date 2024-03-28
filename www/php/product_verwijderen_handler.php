<?php
session_start();
require "database.php";

if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

if (!checkPermissions("Medewerker")) {
    header("Location: index.php");
    exit();
}

$ID = $_GET["id"];

$SQL = "DELETE FROM product WHERE productid = :productid";
$stmt = $conn->prepare($SQL);
$stmt->bindParam(":productid", $ID);
$stmt->execute();

header("Location: ../beheer_producten.php");