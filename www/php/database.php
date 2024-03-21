<?php
$dbhost = "mariadb";
$dbuser = "root";
$dbpass = "password";
$dbname = "restaurant_nova";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


// Auto update session
// Checkt of de gebruiker is ingelogd en haalt de gebruiker gegevens op uit de database
// zodat ze up-to-date zijn
if (isset($_SESSION["ID"])) {
    $sql = "SELECT * FROM gebruiker WHERE gebruikerid = :gebruikerid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":gebruikerid", $_SESSION["ID"]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $_SESSION["rol"] = $result["rol"];
        $_SESSION["firstname"] = $result["voornaam"];
        $_SESSION["lastname"] = $result["achternaam"];
    } else {
        session_destroy();
        header("Location: index.php");
    }
}