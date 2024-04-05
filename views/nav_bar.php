<header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo ou titre de votre site -->
        <a class="navbar-brand" href="#">Logo</a>

       
        <div class="nav_bar">
            <a href="../quartiers/index.php">Quartier</a>
            <a href="../tranches/index.php">Tranche age</a>

            <a href="../status/index.php">status</a>
            <a href="../membres/index.php">membres</a>
        </div>

        <!-- Profil utilisateur -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i>
                    <?php echo $agent_nom; ?>
                    <?php echo $agent_prenom; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="views/agents/index.php">Mon profil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../agents/logout.php">Déconnexion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
</header>