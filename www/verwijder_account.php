<?php
session_start();
require "php/database.php";
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

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
                <form action="php/registratie_handler.php" class="deletion-form" method="post">
                    <h1>Account verwijderen</h1>
                    <p>Weet je zeker dat je je account wilt verwijderen?</p>
                    <br>
                    <input type="submit" value="Ja, verwijder mijn account" class="deletion-btn">
                </form>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>