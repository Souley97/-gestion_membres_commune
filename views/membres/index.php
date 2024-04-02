<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mambre </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <!-- Logo ou titre de votre site -->
                <a class="navbar-brand" href="#">Logo</a>

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
                            <i class="fas fa-user"></i> Utilisateur
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Déconnexion</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <!--formulaire  Ajouter un membre -->
        <?php
        require_once 'create.php';
        ?>
        <?php
        // require_once 'update.php';
        ?>
        <!-- Barre de navigation -->

    </div>

    <div class="container">
        <h1 class="mt-5">Liste des membres de la commune</h1>
        <!-- Ajout d'un bouton d'ajout stylisé avec Bootstrap -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterMembreModal">
            Ajouter un membre
        </button> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifierMembreModal">
            Modifier un membre
        </button>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Tranche d'âge</th>
                    <th scope="col">Sexe</th>
                    <th scope="col">Situation matrimoniale</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date d'enregistrement</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include './models/MembreDB.php';
                $results = new MembreDB($connexion);
                $membres = $results->readAllMembres();

                foreach ($membres as $membre): ?>
                    <tr>
                        <td>
                            <?= $membre['id'] ?>
                        </td>
                        <td>
                            <?= $membre['matricule'] ?>
                        </td>
                        <td>
                            <?= $membre['nom'] ?>
                        </td>
                        <td>
                            <?= $membre['prenom'] ?>
                        </td>
                        <td>
                            <?= $membre['tranche_age'] ?>
                        </td>
                        <td>
                            <?= $membre['sexe'] ?>
                        </td>
                        <td>
                            <?= $membre['situation_matrimoniale'] ?>
                        </td>
                        <td>
                            <?= $membre['statut'] ?>
                        </td>
                        <td>
                            <?= $membre['date_enregistrement'] ?>
                        </td>
                        <td>
                            <!-- Bouton de modification -->
                            <a href="./views/membres/update.php?id=<?= $membre['id'] ?>"
                                class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <!-- Bouton de suppression -->
                            <a href="./controllers/membreController.php?id=<?= $membre['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">
                                <i class="fas fa-trash-alt"></i> Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Intégration de Bootstrap JS (optionnel si vous n'utilisez pas de fonctionnalités JavaScript de Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>