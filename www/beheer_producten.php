<?php
session_start();
require "php/database.php";

$SQL = "SELECT *, menugang.naam AS menugangnaam, product.naam AS productnaam, product_categorie.categorie AS categorienaam
        FROM product 
        JOIN menugang ON product.menugangid = menugang.menugangid
        JOIN product_categorie ON product.categorieid = product_categorie.categorieid";



$stmt = $conn->prepare($SQL);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


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

                    <table>
                        <tr>
                            <th>Product ID</th>
                            <th>Naam</th>
                            <th>Categorie</th>
                            <th>Menugang</th>
                            <th>Vega</th>
                            <th>Voorraad</th>
                            <th>Acties</th>
                        </tr>
                        <?php foreach ($products as $product): ?>

                            <?php 
                            if ($product["is_vega"] == 1) {
                                $product["is_vega"] = "background-color: #86e394;";
                            } else {
                                $product["is_vega"] = "background-color: #ed6172;";
                            }
                                ?>

                            <tr>
                                <td><?php echo $product["productid"]; ?></td>
                                <td><?php echo $product["productnaam"]; ?></td>
                                <td><?php echo $product["categorienaam"]; ?></td>
                                <td><?php echo $product["menugangnaam"]; ?></td>
                                <td style="<?php echo $product["is_vega"]?>"></td>        
                                <td><?php echo $product["aantal_voorraad"]; ?></td>
                                <td>
                                    <a href="product_bewerken.php?id=<?php echo $product["productid"]; ?>">Bewerken</a>
                                    <a href="php/product_verwijderen_handler.php?id=<?php echo $product["productid"]; ?>">Verwijderen</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </section>
                <nav class="product-action-nav">
                        <ul>
                            <li><a href="product_create.php">Product toevoegen</a></li>         <!-- how unfishable, that the fish fished the fish-->
                            <li><a href="categorie_create.php">Categorie toevoegen</a></li>     <!-- how unfishable, that the fish fished the fish-->
                            <li><a href="menugang_create.php">Menugang toevoegen</a></li>       <!-- how unfishable, that the fish fished the fish-->
                        </ul>
                    </nav>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>