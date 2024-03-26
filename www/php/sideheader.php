<nav class="side-nav">
    <h3>Medewerker's paneel</h3>
    <hr class="white-hr">
    <ul class="side-nav-list">
        <?php if (checkPermissions("Medewerker")) { ?>
            <li class="side-nav-item">
                <a href="beheer_producten.php" class="side-nav-link">Producten</a>
            </li>
        <?php } ?>
        <?php if (checkPermissions("Medewerker")) { ?>
            <li class="side-nav-item">
                <a href="beheer_reserveringen.php" class="side-nav-link">Reserveringen</a>
            </li>
        <?php } ?>
        <?php if (checkPermissions("Manager")) { ?>
            <li class="side-nav-item">
                <a href="beheer_gebruikers.php" class="side-nav-link">Gebruikers</a>
            </li>
        <?php } ?>
    </ul>
</nav>