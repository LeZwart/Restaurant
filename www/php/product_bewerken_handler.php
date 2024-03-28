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

$naam = $_POST["productnaam"];
$menugangid = $_POST["menugangid"];
$categorieid = $_POST["categorieid"];
$vega = $_POST["vega"];
$voorraad = $_POST["voorraad"];
$productid = $_POST["productid"];

$SQL = "UPDATE product SET naam = :naam, menugangid = :menugangid, categorieid = :categorieid, is_vega = :vega, aantal_voorraad = :voorraad WHERE productid = :productid";