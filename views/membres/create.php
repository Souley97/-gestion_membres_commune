<!-- Modal -->
<div class="modal fade" id="ajouterMembreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout de membre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../controllers/membreController.php" method="POST">
                    <!-- 
                        <div class="form-group">
                        <label for="matricule">matricule :</label>
                        <input type="hidden" class="form-control" id="matricule" name="matricule" required>
                    </div> 
                -->
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe :</label>
                        <select class="form-control" id="sexe" name="sexe" required>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="situation_matrimoniale">Situation matrimoniale :</label>
                        <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale" required>
                            <option value="Celibataire">Celibataire</option>
                            <option value="Marie">Marie</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="etat">Etat</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="actif">actif</option>
                            <option value="retraite">Retraite</option>
                            <option value="chomeur">Chomeur</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label for="idStatut">Statut :</label>
                            <select class="form-control" id="idStatut" name="idStatut" required>
                                <!-- Options dynamiques chargées à partir de la base de données -->
                                <?php
                                require_once '../../models/MembreDB.php';
                                $results = new MembreDB($connexion);
                                // $membres = $results->membresCivile();
                                $statuts = $results->getStatuts(); ?>
                                <?php foreach ($statuts as $statut): ?>
                                    <option value="<?= $statut['id'] ?>">
                                        <?= $statut['libelle'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="idQuartier">Quartier :</label>
                            <select class="form-control" id="idQuartier" name="idQuartier" required>
                                <!-- Options dynamiques chargées à partir de la base de données -->
                                <?php
                                require_once '../../models/MembreDB.php';
                                $results = new MembreDB($connexion);
                                // $membres = $results->membresCivile();
                                $quartiers = $results->getQuartiers(); ?>
                                <?php foreach ($quartiers as $quartier): ?>
                                    <option value="<?= $quartier['id'] ?>">
                                        <?= $quartier['libelle'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="idAge">Age :</label>
                            <select class="form-control" id="idAge" name="idAge" required>
                                <!-- Options dynamiques chargées à partir de la base de données -->
                                <?php
                                require_once '../../models/MembreDB.php';
                                $results = new MembreDB($connexion);
                                // $membres = $results->membresCivile();
                                $ages = $results->getTranchesAge(); ?>
                                <?php foreach ($ages as $age): ?>
                                    <option value="<?= $age['id'] ?>">
                                        <?= $age['libelle'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>

                    <button type="submit" name="addM" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>