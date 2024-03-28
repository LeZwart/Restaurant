<?php
session_start();
require 'database.php';


$error_message = "";
$error_state = false;

if (!isset($_SESSION["ID"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $error_state = true;
    $error_message .= "ERROR: Requst method is not POST <br>";
}

$email = $_POST["email"];
$voornaam = $_POST["voornaam"];
$achternaam = $_POST["achternaam"];

$straatnaam = $_POST["straatnaam"];
$huisnummer = $_POST["huisnummer"];
$postcode = $_POST["postcode"];
$woonplaats = $_POST["woonplaats"];

if (empty($email) || empty($voornaam) || empty($achternaam) || empty($straatnaam) || empty($huisnummer) || empty($postcode) || empty($woonplaats)) {
    $error_state = true;
    $error_message .= "ERROR: One or more fields are empty <br>";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_state = true;
    $error_message .= "ERROR: Email is not valid <br>";
}

if ($error_state) {
    echo $error_message;
    exit();
}

$SQL = "SELECT * FROM gebruiker WHERE gebruikerid = :gebruikerid";
$stmt = $conn->prepare($SQL);
$stmt->bindParam(":gebruikerid", $_SESSION["ID"]);
$stmt->execute();
$gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

$adresid = $gebruiker["adresid"];

$adres_sql = "UPDATE adres SET postcode = :postcode, huisnummer = :huisnummer, woonplaats = :woonplaats, straatnaam = :straatnaam WHERE adresid = :adresid";
$gebruiker_sql = "UPDATE gebruiker SET email = :email, voornaam = :voornaam, achternaam = :achternaam, adresid = :adresid WHERE gebruikerid = :gebruikerid";

$stmt_adres = $conn->prepare($adres_sql);
$stmt_adres->bindParam(":postcode", $postcode);
$stmt_adres->bindParam(":huisnummer", $huisnummer);
$stmt_adres->bindParam(":woonplaats", $woonplaats);
$stmt_adres->bindParam(":straatnaam", $straatnaam);
$stmt_adres->bindParam(":adresid", $adresid);

$result_adres = $stmt_adres->execute();
if (!$result_adres) {
    echo "ERROR: Adres update failed";
    exit();
}

$stmt_gebruiker = $conn->prepare($gebruiker_sql);
$stmt_gebruiker->bindParam(":email", $email);
$stmt_gebruiker->bindParam(":voornaam", $voornaam);
$stmt_gebruiker->bindParam(":achternaam", $achternaam);
$stmt_gebruiker->bindParam(":adresid", $adresid);
$stmt_gebruiker->bindParam(":gebruikerid", $_SESSION["ID"]);

$result_gebruiker = $stmt_gebruiker->execute();

if ($result_gebruiker) {
    header("Location: ../account.php");
} else {
    echo "ERROR: Gebruiker update failed";
    exit();
}

