<?php
session_start();

require "database.php";

if (!isset($_SESSION["ID"])) {
    header("Location: ../login.php");
    exit();
}

$ID = $_SESSION["ID"];

// get adres id
$sql = "SELECT adresid FROM gebruiker WHERE gebruikerid = :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":ID", $ID);
$stmt->execute();

$adresid = $stmt->fetch(PDO::FETCH_ASSOC)["adresid"];

// delete gebruiker
$sql = "DELETE FROM gebruiker WHERE gebruikerid = :ID";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":ID", $ID);
$stmt->execute();

// delete adres
$sql = "DELETE FROM `adres` WHERE `adres`.`adresid` = :adresid ";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":adresid", $adresid);
$stmt->execute();

session_destroy();
header("Location: ../index.php");