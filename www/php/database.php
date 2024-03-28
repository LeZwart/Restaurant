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


// Checkt of de gebruiker de juiste permissies heeft
function checkPermissions($requiredRole) {
    
    // level van rollen
    $roles = [
        "Klant" => 0,
        "Medewerker" => 1,
        "Manager" => 2,
        "Directeur" => 3
    ];

    if (isset($_SESSION["rol"]) && isset($roles[$requiredRole])) {

        // level van de gebruiker en de vereiste rol
        $userRoleLevel = $roles[$_SESSION["rol"]];
        $requiredRoleLevel = $roles[$requiredRole];
        
        // Vergelijk levels
        return $userRoleLevel >= $requiredRoleLevel;
    }
    return false;
}

function GetUser($id, $conn) {
    $sql = "SELECT * FROM gebruiker WHERE gebruikerid = :gebruikerid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":gebruikerid", $id);
    $stmt->execute();

    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);
    return $gebruiker;
}

function GetUserAdres($id, $conn) {
    $sql = "SELECT * FROM adres WHERE adresid = :adresid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":adresid", GetUser($id, $conn)["adresid"]);
    $stmt->execute();

    $adres = $stmt->fetch(PDO::FETCH_ASSOC);

    return $adres;
}
