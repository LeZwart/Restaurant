<?php
session_start();
require "php/database.php";
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

if (!checkPermissions("Medewerker")) {
    header("Location: dashboard.php");
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
                <?php 
                if (checkPermissions("Medewerker")) {
                    require "php/sideheader.php";
                }
                ?>
                <section class="menu-container">
                    <table>
                        <tr>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Email</th>
                            <th>Adres</th>
                            <th>Postcode</th>
                            <th>Woonplaats</th>
                            <th>Rol</th>
                            <?php if (checkPermissions("Manager")) { echo "<th>Acties</th>"; }?>
                        </tr>
                        <?php
                        $query = "  SELECT gebruiker.voornaam, gebruiker.achternaam, gebruiker.email, adres.straatnaam, adres.huisnummer, adres.postcode, adres.woonplaats, gebruiker.rol 
                                    FROM gebruiker INNER JOIN adres 
                                    ON gebruiker.adresid = adres.adresid";


                        $stmt = $conn->prepare($query);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach ($result as $row):?>
                        <tr>
                            <td><?php echo $row["voornaam"]; ?></td>
                            <td><?php echo $row["achternaam"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["straatnaam"] . " " . $row["huisnummer"]; ?></td>
                            <td><?php echo $row["postcode"]; ?></td>
                            <td><?php echo $row["woonplaats"]; ?></td>
                            <td><?php echo $row["rol"]; ?></td>
                            <?php if (checkPermissions("Manager")) { 
                                
                             }?>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </section>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>
