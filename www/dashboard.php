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
                <h2>Welkom bij NOVA Restaurant, <?php echo $_SESSION["firstname"]; ?>!</h2>

                <nav class="side-nav">
                    <ul class="side-nav-list">
                        <li class="side-nav-item">
                            <a href="bestellingen.php" class="side-nav-link">Bestellingen</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="menu.php" class="side-nav-link">Menu</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="reserveringen.php" class="side-nav-link">Reserveringen</a>
                        </li>
                        <li class="side-nav-item">
                            <a href="account.php" class="side-nav-link">Account</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>