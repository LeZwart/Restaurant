<?php
session_start();
require "php/database.php";
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

$ID = $_SESSION["ID"];
$gebruiker = GetUser($ID, $conn);
$adres = GetUserAdres($ID, $conn);

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
                <?php 
                if (checkPermissions("Medewerker")) {
                    require "php/sideheader.php";
                }
                ?>
                <section>
                    
                    <form action="php/account_update_handler.php" method="POST" class="user-data-form">
                        <h2>Accountgegevens</h2>
                        <label for="voornaam">Voornaam</label>
                        <input type="text" name="voornaam" value="<?php echo $gebruiker["voornaam"] ?>">

                        <label for="achternaam">Achternaam</label>
                        <input type="text" name="achternaam" value="<?php echo $gebruiker["achternaam"] ?>">

                        <label for="straatnaam">Straatnaam</label>
                        <input type="text" name="straatnaam" value="<?php echo $adres["straatnaam"] ?>">

                        <label for="huisnummer">Huisnummer</label>
                        <input type="text" name="huisnummer" value="<?php echo $adres["huisnummer"] ?>">

                        <label for="postcode">Postcode</label>
                        <input type="text" name="postcode" value="<?php echo $adres["postcode"] ?>">

                        <label for="woonplaats">Woonplaats</label>
                        <input type="text" name="woonplaats" value="<?php echo $adres["woonplaats"] ?>">

                        <label for="email">E-mail</label>
                        <input type="text" name="email" value="<?php echo $gebruiker["email"] ?>">

                        <input type="submit" value="Opslaan" class="option-btn">
                    </form>
                </section>
                <section>
                    <form action="php/account_password_handler.php" method="post" class="user-data-form">
                        <h2>Wachtwoord wijzigen</h2>
                        <label for="oud-wachtwoord">Oud wachtwoord</label>
                        <input type="password">

                        <label for="nieuw-wachtwoord">Nieuw wachtwoord</label>
                        <input type="password">

                        <label for="herhaal-wachtwoord">Herhaal wachtwoord</label>
                        <input type="password">

                        <input type="submit" value="Opslaan" class="option-btn">
                    </form>
                    <a class="deletion-btn" href="verwijder_account.php">ACCOUNT VERWIJDEREN</a>
                </section>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>