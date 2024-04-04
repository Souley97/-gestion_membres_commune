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
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" id="nom" name="matricule" required>
                    </div>
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
                            <option value="Divorce">Divorcé(e)</option>
                            <option value="Veuf">Veuf(ve)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="etat">État :</label>
                        <select class="form-control" id="etat" name="etat" required>
                            <option value="actif">Actif</option>
                            <option value="retraite">Retraité</option>
                            <option value="chomeur">Chômeur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idQuartier">Quartier :</label>
                        <!-- Ici, vous pouvez charger dynamiquement les quartiers depuis la base de données -->
                        <select class="form-control" id="idQuartier" name="idQuartier" required>
                            <option value="1">Quartier 1</option>
                            <option value="2">Quartier 2</option>
                            <!-- Ajoutez les options pour les autres quartiers -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idTrancheAge">Tranche d'âge :</label>
                        <!-- Ici, vous pouvez charger dynamiquement les tranches d'âge depuis la base de données -->
                        <select class="form-control" id="idTrancheAge" name="isAge" required>
                            <option value="1">0 - 18 ans</option>
                            <option value="2">18 - 35 ans</option>
                            <!-- Ajoutez les options pour les autres tranches d'âge -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idStatut">Statut :</label>
                        <!-- Ici, vous pouvez charger dynamiquement les statuts depuis la base de données -->
                        <select class="form-control" id="idStatut" name="idStatut" required>
                            <option value="1">Statut 1</option>
                            <option value="2">Statut 2</option>
                            <!-- Ajoutez les options pour les autres statuts -->
                        </select>
                    </div>
                    <button type="submit" name="addMembre" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>