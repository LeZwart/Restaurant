<?php
session_start();

if (isset($_SESSION["ID"])) {
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
        <?php require "php/header_no_login.php"; ?>
        <main>
            <section class="form-section">
                <h1>Inloggen</h1>
                <form action="php/login_handler.php" class="login-form" method="post">
                    <div class="login-form-group">
                        <label for="email" class="login-form-label">E-mail</label>
                        <input type="email" id="email" name="email" class="login-form-input">
                    </div>
                    <div class="login-form-group">
                        <label for="password" class="login-form-label">Wachtwoord</label>
                        <input type="password" id="password" name="password" class="login-form-input">
                    </div>
                    <button type="submit" class="login-button">Log in</button>
                    <a class="link" href="registratie.php">Heb je nog geen account? Maak er een aan</a>
                </form>
            </section>
        </main>
    </body>
</html>