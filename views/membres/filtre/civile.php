<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Liste des civiles</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div>
                <!-- Ajout d'un bouton d'ajout stylisé avec Bootstrap -->


                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">âge</th>
                            <th scope="col">Sexe</th>
                            <th scope="col">Situation </th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../../models/MembreDB.php';
                        $results = new MembreDB($connexion);
                        $membres = $results->membresCivile();
                        // $membres = $results->readAllMembres();
                        
                        foreach ($membres as $membre): ?>
                            <tr>

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

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>