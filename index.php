<!DOCTYPE html>
<html lang="en">

<?php
include 'models/DB.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <title>Index </title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Logo ou titre de votre site -->
                <img src="public/image/images.jpeg" alt="logo_commune">
                <!-- <a class="navbar-brand" href="#">Logo</a> -->

                <!-- Contenu de la barre de recherche -->
                <form class="form-inline my-2 my-lg-0 mr-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher..." aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>

                <!-- Profil utilisateur -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php echo $agent_nom; ?>
                            <?php echo $agent_prenom; ?>
                        </a>
                       <a href="views/agents/login.php"> <button>Connexion</button></a>
                       <!-- <a href="views/membres/index.php"><button>LISTE MEMBRES</button></a>  -->
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="views/agents/index.php">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./views/agents/logout.php">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
</body>

</html>