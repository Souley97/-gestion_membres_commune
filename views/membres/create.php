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
                <form action="./controllers/membreController.php" method="POST">
                    <div class="form-group">
                        <label for="matricule">Matricule:</label>
                        <input type="text" class="form-control" id="matricule" name="matricule" required>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="tranche_age">Tranche d'âge:</label>
                        <input type="text" class="form-control" id="tranche_age" name="tranche_age">
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe:</label>
                        <select class="form-control" id="sexe" name="sexe">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="situation_matrimoniale">Situation matrimoniale:</label>
                        <select class="form-control" id="situation_matrimoniale" name="situation_matrimoniale">
                            <option value="Célibataire">Célibataire</option>
                            <option value="Marié">Marié</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut:</label>
                        <select class="form-control" id="statut" name="statut">
                            <option value="Chef de quartier">Chef de quartier</option>
                            <option value="Civile">Civile</option>
                            <option value="Badian Gokh">Badian Gokh</option>
                        </select>
                    </div>
                    <button type="submit" name="addMembre" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>