<!-- Modal -->
<div class="modal fade" id="ajouterQuartierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="../../controllers/quartierController.php" method="POST">
                    <div class="form-group">
                        <label for="libelle">Libelle :</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>
                   


                    <button type="submit" name="addM" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>