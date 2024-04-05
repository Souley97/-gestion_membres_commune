<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Membre</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php
    require_once "../nav_bar.php";

    ?>
    <div class="container">
        <h1>Détails du Membre</h1>
        <?php
        require_once '../../models/MembreDB.php';

        // Vérifier si un ID de membre est passé en paramètre dans l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            $results = new MembreDB($connexion);
            // $membres = $results->membresCivile();
            $membre = $results->getUnMembre($id);
            if ($membre) { ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $membre['nom'] ?>
                            <?= $membre['prenom'] ?>
                        </h5>
                        <p class="card-text"><strong>Matricule:</strong>
                            <?= $membre['matricule'] ?>
                        </p>
                        <p class="card-text"><strong>Sexe:</strong>
                            <?= $membre['sexe'] ?>
                        </p>
                        <p class="card-text"><strong>Situation Matrimoniale:</strong>
                            <?= $membre['situation_matrimoniale'] ?>
                        </p>
                        <p class="card-text"><strong>Etat:</strong>
                            <?= $membre['etat'] ?>
                        </p>
                        <p class="card-text"><strong>Date d'Enregistrement:</strong>
                            <?= $membre['date_enregistrement'] ?>
                        </p>
                        <p class="card-text"><strong>Quartier:</strong>
                            <?= $membre['quartier'] ?>
                        </p>
                        <p class="card-text"><strong>Tranche d'âge:</strong>
                            <?= $membre['tranche_age'] ?>
                            <?= $membre['age_min'] ?>
                            <?= $membre['age_max'] ?>
                        </p>
                        <p class="card-text"><strong>Statut:</strong>
                            <?= $membre['statut'] ?>
                        </p>
                    </div>
                </div>
                <?php

            } else {
                echo "Aucun membre trouvé.";
            }
        } else {
            echo "ID de membre non spécifié.";
        }
        ?>
        <a href="index.php" class="btn btn-primary mt-3">Retour à la liste des membres</a>
    </div>
</body>

</html>