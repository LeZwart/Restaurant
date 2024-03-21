<?php
session_start();
require "php/database.php";
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM gebruiker WHERE gebruikerid = :gebruikerid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":gebruikerid", $_SESSION["ID"]);
$stmt->execute();

$gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM adres WHERE adresid = :adresid";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":adresid", $gebruiker["adresid"]);
$stmt->execute();

$adres = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>NOVA Restaurant</title>
    </head>
    <body>
        <?php require "php/header.php"; ?>
        <main>
            <section class="main-section">
                <section class="test-section">

                </section>
                <section class="test-section">

                </section>
                <section class="test-section">
                    <a class="option-btn" style="background-color: red;" href="verwijder_account.php">Verwijder Account</a>
                </section>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>