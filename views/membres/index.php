<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mambre </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <div class="container mt-5">
        <!--formulaire  Ajouter un membre -->
        <?php
        require_once 'create.php';
        ?>


    </div>

    <div class="container">
        <h1 class="mt-5">Liste des membres de la commune</h1>
        <!-- Ajout d'un bouton d'ajout stylisé avec Bootstrap -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajouterMembreModal">
            Ajouter un membre
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