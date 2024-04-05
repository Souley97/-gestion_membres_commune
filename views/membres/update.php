<?php
session_start(); // Vérifier si l'agent est connecté 
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
} // Afficher le nom de l'agent 
$agent_nom = $_SESSION["nom"];
$agent_prenom = $_SESSION["prenom"]; ?>
<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mambre </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <!-- Profil utilisateur -->
    <?php
    require_once "../nav_bar.php";

    ?>
    
    <div class="container mt-5">
       
        <div class="row">
        <h5 class="modal-title" id="exampleModalLabel">Modifier un membre</h5>

            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <?php
                    require_once '../../models/MembreDB.php';

                    // Vérifier si un ID de membre est passé en paramètre dans l'URL
                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $id = $_GET['id'];

                        // Inclure la classe MembreDB
                    
                        // Créer une instance de MembreDB avec la connexion à la base de données
                        $membreDB = new MembreDB($connexion);

                        // Obtenir les informations du membre à éditer
                        $membre = $membreDB->getMembreById($id);

                        // Vérifier si le membre existe
                        if ($membre) {
                            ?>
                            <!-- Formulaire de modification -->
                            <form action="../../controllers/membreController.php" method="POST">
                                <input type="hidden" class="form-control" id="id" name="id" value="<?= $membre['id'] ?>"
                                    required>

                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $membre['nom'] ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom"
                                        value="<?= $membre['prenom'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="sexe">Sexe:</label>
                                    <select class="form-control" id="sexe" name="sexe">
                                        <option value="Homme" <?= $membre['sexe'] == 'Homme' ? 'selected' : '' ?>>Homme</option>
                                        <option value="Femme" <?= $membre['sexe'] == 'Femme' ? 'selected' : '' ?>>Femme</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="situation_matrimoniale">Situation matrimoniale :</label>
                                    <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale"
                                        required>
                                        <option value="Célibataire" <?= $membre['situation_matrimoniale'] == 'Célibataire' ? 'selected' : '' ?>>Célibataire</option>
                                        <option value="Marié" <?= $membre['situation_matrimoniale'] == 'Marié' ? 'selected' : '' ?>>
                                            Marié</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="etat">Etat :</label>
                                    <select class="form-control" id="etat" name="etat" required>
                                        <option value="actif" <?= $membre['etat'] == 'actif' ? 'selected' : '' ?>>Actif</option>
                                        <option value="retraite" <?= $membre['etat'] == 'retraite' ? 'selected' : '' ?>>Retraite
                                        </option>
                                        <option value="chomeur" <?= $membre['etat'] == 'chomeur' ? 'selected' : '' ?>>Chomeur
                                        </option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idStatut">Statut :</label>
                                    <select class="form-control" id="idStatut" name="idStatut" required>
                                        <!-- Options dynamiques chargées à partir de la base de données -->
                                        <?php
                                        require_once '../../models/MembreDB.php';
                                        $results = new MembreDB($connexion);
                                        $statuts = $results->getStatuts();
                                        foreach ($statuts as $statut): ?>
                                            <option value="<?= $statut['id'] ?>">
                                                <?= $statut['libelle'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idQuartier">Quartier :</label>
                                    <select class="form-control" id="idQuartier" name="idQuartier" required>
                                        <!-- Options dynamiques chargées à partir de la base de données -->
                                        <?php
                                        $quartiers = $results->getQuartiers();
                                        foreach ($quartiers as $quartier): ?>
                                            <option value="<?= $quartier['id'] ?>">
                                                <?= $quartier['libelle'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idAge">Age :</label>
                                    <select class="form-control" id="idAge" name="idAge" required>
                                        <!-- Options dynamiques chargées à partir de la base de données -->
                                        <?php
                                        $ages = $results->getTranchesAge();
                                        foreach ($ages as $age): ?>
                                            <option value="<?= $age['id'] ?>">
                                                <?= $age['libelle'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" name="editMembre" class="btn btn-primary">Modifier</button>
                            </form>


                            <?php
                        } else {
                            echo "Aucun membre trouvé.";
                        }
                    } else {
                        echo "ID de membre non spécifié.";
                    }
                    ?>
                </div>
                </div>
    </div>
    </div>
                <!-- Intégration de Bootstrap JS (optionnel si vous n'utilisez pas de fonctionnalités JavaScript de Bootstrap) -->
                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>