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
            <section class="registration-section">
                <h1>Account aanmaken</h1>
                <form action="registratie_handler.php" class="registratie-form" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">Gebruikersnaam</label>
                            <div>
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" id="email" name="email" class="form-input">
                            </div>
                            <div>
                                <label for="password" class="form-label">Wachtwoord</label>
                                <input type="password" id="password" name="password" class="form-input">
                            </div>
                        </section>
                        <section>

                        </section>
                        <button type="submit" class="registration-button">Account aanmaken</button>
                </form>
            </section>
        </main>
    </body>
</html>