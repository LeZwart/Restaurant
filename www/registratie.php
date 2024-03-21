<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>NOVA Restaurant</title>
    </head>
    <body>
        <main>
            <section class="form-section">
                <h1>Account aanmaken</h1>
                <form action="registratie_handler.php" class="registratie-form" method="post">
                    <section class="registratie-form-group">
                        <h2>Accountgegevens</h2>
                        <div class="form-input">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                        </div>
                        <div class="form-input">
                            <label for="password" class="form-label">Wachtwoord</label>
                            <input type="password" id="password" name="password" class="form-input"required>
                        </div>
                        <div class="form-input">
                            <label for="firstname" class="form-label">Voornaam</label>
                            <input type="text" name="firstname"required>
                        </div>
                        <div class="form-input">
                            <label for="lastname" class="form-label">Achternaam</label>
                            <input type="text" name="lastname"required>
                        </div>
                    </section>
                    <section class="registratie-form-group">
                        <h2>Adresgegevens</h2>
                        <div class="form-input">
                            <label for="street" class="form-label">Straatnaam</label>
                            <input type="text" name="street"required>
                        </div class="form-input">
                        <div class="form-input">
                            <label for="huisnummer" class="form-label">Huisnummer</label>
                            <input type="text" name="huisnummer"required>
                        </div>
                        <div class="form-input">
                            <label for="woonplaats" class="form-label">Woonplaats</label>
                            <input type="text" name="woonplaats"required>
                        </div>
                        <div class="form-input">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" name="postcode"required>
                        </div>
                    </section>
                    <div class="form-input" style="grid-column: span 2;">
                        <button type="submit" class="registratie-button">Account aanmaken</button>
                        <a href="login.php">Heb je al een account? Log in</a>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>