<?php

$error_message = "";
$error_state = false;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $error_state = true;
    $error_message .= "ERROR: Requst method is not POST <br>";
}

$email = $_POST["email"];
$wachtwoord = $_POST["password"];

if (empty($email) || empty($wachtwoord)) {
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

require "php/database.php";

$sql = "SELECT * FROM gebruiker WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":email", $email);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    if (password_verify($wachtwoord, $result["wachtwoord"])) {
        session_start();
        $_SESSION["ID"] = $result["gebruikerid"];
        $_SESSION["rol"] = $result["rol"];
        $_SESSION["firstname"] = $result["voornaam"];
        $_SESSION["lastname"] = $result["achternaam"];
        header("Location: dashboard.php");
    }
}

header("Location: login.php")
?>