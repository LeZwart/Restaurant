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
            <section class="main-section">
                <h1>Welkom bij NOVA Restaurant</h1>
                <p>Welkom bij NOVA Restaurant, <?php echo $_SESSION["firstname"]; ?>!</p>
                <p>Je bent nu ingelogd en kunt beginnen met het bestellen van heerlijke gerechten.</p>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>