<?php

$error_message = "";
$error_state = false;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $error_state = true;
    $error_message .= "ERROR: Requst method is not POST <br>";
}

$email = $_POST["email"];
$wachtwoord = $_POST["password"];
$voornaam = $_POST["firstname"];
$achternaam = $_POST["lastname"];

$straatnaam = $_POST["street"];
$huisnummer = $_POST["huisnummer"];
$postcode = $_POST["postcode"];
$woonplaats = $_POST["woonplaats"];

if (empty($email) || empty($wachtwoord) || empty($voornaam) || empty($achternaam) || empty($straatnaam) || empty($huisnummer) || empty($postcode) || empty($woonplaats)) {
    $error_state = true;
    $error_message .= "ERROR: One or more fields are empty <br>";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_state = true;
    $error_message .= "ERROR: Email is not valid <br>";
}

$wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

if ($error_state) {
    echo $error_message;
    exit();
}

require "php/database.php";

$adres_sql = "INSERT INTO adres (postcode, huisnummer, woonplaats, straatnaam) VALUES (:postcode, :huisnummer, :woonplaats, :straatnaam)";
$gebruiker_sql = "INSERT INTO gebruiker (email, wachtwoord, voornaam, achternaam, adresid, rol) VALUES (:email, :wachtwoord, :voornaam, :achternaam, :adresid, 'klant')";

$stmt_adres = $conn->prepare($adres_sql);
$stmt_adres->bindParam(":postcode", $postcode);
$stmt_adres->bindParam(":huisnummer", $huisnummer);
$stmt_adres->bindParam(":woonplaats", $woonplaats);
$stmt_adres->bindParam(":straatnaam", $straatnaam);

$result_adres = $stmt_adres->execute();

$stmt_gebruiker = $conn->prepare($gebruiker_sql);
$stmt_gebruiker->bindParam(":email", $email);
$stmt_gebruiker->bindParam(":wachtwoord", $wachtwoord);
$stmt_gebruiker->bindParam(":voornaam", $voornaam);
$stmt_gebruiker->bindParam(":achternaam", $achternaam);
$stmt_gebruiker->bindParam(":adresid", $conn->lastInsertId());

$result_gebruiker = $stmt_gebruiker->execute();


if ($result_adres && $result_gebruiker) {
    $_SESSION["ID"] = $conn->lastInsertId();
} else {
    echo "ERROR: Account aanmaken mislukt";
}