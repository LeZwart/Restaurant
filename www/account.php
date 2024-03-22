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
            <section class="main-section account-section">
                <section class="">
                    <h2>Accountgegevens</h2>
                    <form action="php/account_update_handler.php" method="post">
                        <label for="voornaam">Voornaam</label>
                        <input type="text" value="<?php echo $gebruiker["voornaam"] ?>">

                        <label for="achternaam">Achternaam</label>
                        <input type="text" value="<?php echo $gebruiker["achternaam"] ?>">

                        <label for="straatnaam">Straatnaam</label>
                        <input type="text" value="<?php echo $adres["straatnaam"] ?>">

                        <label for="huisnummer">Huisnummer</label>
                        <input type="text" value="<?php echo $adres["huisnummer"] ?>">

                        <label for="postcode">Postcode</label>
                        <input type="text" value="<?php echo $adres["postcode"] ?>">

                        <label for="woonplaats">Woonplaats</label>
                        <input type="text" value="<?php echo $adres["woonplaats"] ?>">

                        <label for="email">E-mail</label>
                        <input type="text" value="<?php echo $gebruiker["email"] ?>">

                        <input type="submit" value="Opslaan" class="option-btn">
                    </form>
                </section>
                <section class="">
                    
                </section>

                <section class="">
                    <a class="option-btn" style="background-color: red;" href="verwijder_account.php">Verwijder Account</a>
                </section>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>