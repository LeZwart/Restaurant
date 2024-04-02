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

if (!isset($_POST["productnaam"]) || !isset($_POST["menugangid"]) || !isset($_POST["categorieid"]) || !isset($_POST["vega"]) || !isset($_POST["voorraad"]) || !isset($_POST["productid"])) {
    header("Location: ../product_bewerken.php?id=" . $_POST["productid"]);
    exit();
}

$productid = $_POST["productid"];
$menugangid = $_POST["menugangid"];
$categorieid = $_POST["categorieid"];

$naam = $_POST["productnaam"];
$vega = $_POST["vega"];
$voorraad = $_POST["voorraad"];


$SQL = "UPDATE product SET naam = :naam, menugangid = :menugangid, categorieid = :categorieid, is_vega = :vega, aantal_voorraad = :voorraad 
        WHERE productid = :productid";
