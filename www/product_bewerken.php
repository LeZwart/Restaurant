<?php
session_start();
require "php/database.php";
if (!isset($_SESSION["ID"])) {
    header("Location: login.php");
    exit();
}

if (!checkPermissions("Medewerker")) {
    header("Location: index.php");
    exit();
}

$SQL = "SELECT * FROM menugang";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$menugangen = $stmt->fetchAll(PDO::FETCH_ASSOC);

$SQL = "SELECT * FROM product_categorie";
$stmt = $conn->prepare($SQL);
$stmt->execute();
$product_categorie = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($product_categorie);
// die();

$SQL = "SELECT * FROM product WHERE productid = :productid";
$stmt = $conn->prepare($SQL);
$stmt->bindParam(":productid", $_GET["id"]);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
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
                    <form action="php/product_bewerken_handler.php" method="POST" class="user-data-form">
                        <h2>Product bewerken</h2>
                        <input type="hidden" name="productid" value="<?php echo $product["productid"] ?>">
                        <label for="productnaam">Productnaam</label>
                        <input type="text" name="productnaam" value="<?php echo $product["naam"] ?>">

                        <label for="inkoopprijs">Inkoop Prijs</label>
                        <input type="number" name="inkoopprijs" value="<?php echo $product["inkoopprijs"] ?>">

                        <label for="verkoopprijs">Verkoop Prijs</label>
                        <input type="number" name="verkoopprijs" value="<?php echo $product["verkoopprijs"] ?>">

                        <textarea name="beschrijving" id="beschrijving" cols="30" rows="10"><?php echo $product["beschrijving"] ?></textarea>

                        <label for="categorieid">Categorie</label>
                        <select name="categorieid">
                            <?php foreach ($product_categorie as $categorie): ?>
                            <option value="<?php echo $categorie["categorieid"] ?>"><?php echo $categorie["categorie"] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="menugangid">Menugang</label>
                        <select name="menugangid">
                            <?php foreach ($menugangen as $menugang): ?>
                            <option value="<?php echo $menugang["menugangid"] ?>"><?php echo $menugang["naam"] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label for="vega">Vega</label>
                        <input type="checkbox" name="vega" checked>

                        <button type="submit">Bewerk</button>
                    </form>
            </section>
        </main>
        <?php require "php/footer.php"; ?>
    </body>
</html>