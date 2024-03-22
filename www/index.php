<?php
session_start();

if (isset($_SESSION["ID"])) {
    header("Location: dashboard.php");
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
        <?php require "php/header_no_login.php"; ?>
        <main class="main-page-index">
            <section class="index-section" id="text-section">
                <h1>Welkom bij het Oostenrijkse NOVA Restaurant</h1>
                <p>Een heerlijke en gezellige avond beleef je bij ons!</p>
                <img src="img/showcase_images/5.jpg" id="food-display">
            </section>
            <section class="index-section" id="button-section">
                <a href="registratie.php" class="main-page-button">Account aanmaken</a>
                <a href="login.php" class="main-page-button">Inloggen</a>
                <a href="menukaart.php" class="main-page-button">Menukaart</a>
            </section>
        </main>
        
        <script src="js/script.js"></script>
    </body>
</html>