<?php
session_start();
require "database.php";

if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

if (!checkPermissions("Medewerker")) {
    header("Location: dashboard.php");
    exit();
}

$categorie = $_POST["categorie"];

if (empty($categorie)) {
    header("Location: categorie_create.php");
    exit();
}

if (isset($_POST["submit"])) {
    $query = "INSERT INTO product_categorie (categorie) VALUES (:categorie)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":categorie", $categorie);
    $stmt->execute();
    header("Location: categorie_create.php");
}