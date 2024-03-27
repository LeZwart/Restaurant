<?php
session_start();
require "php/database.php";

$SQL = "SELECT * FROM menugang";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$menugangen = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en" style="overflow-y: scroll;">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>NOVA Restaurant</title>
    </head>
    <body>
        <?php
        if (isset($_SESSION["ID"])) {
            require "php/header.php";
        } else {
            require "php/header_no_login.php";
        }
        ?>
        <main>
            
            <section class="main-section ">
                <?php 
                if (checkPermissions("Medewerker")) {
                    require "php/sideheader.php";
                }
                ?>

                <section class="menu-container">
                    <?php foreach ($menugangen as $menugang): ?>
                        <article class="menu-item">
                        <a href="#">
                            <img src="https://placehold.co/200">
                            <hr class="white-hr">
                            <h3><?php echo $menugang["naam"]; ?></h3>
                        </a>
                    </article>
                    <?php endforeach; ?>
                </section>
                
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>