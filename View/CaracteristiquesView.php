<?php 

require_once('../View/pageAdmin.php');

class CaracteristiquesView extends pageAdmin
{
    public function CaracteristiqueAffich($caracteristiques)
    {
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="background-color:#CAF0F8;">
                        <div class="card-header" style="background-color:#90E0EF;">
                            <h2>Caractéristiques du Véhicule</h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php
                                       echo '<img src="' . $caracteristiques['ImageVehicule'] . '" alt="Photo vehicule" class="img-fluid" style="width:150%; height : 30%;">';
                                    ?>
                                </div>
                                <div class="col-md-8">
                                    <?php if ($caracteristiques) : ?>
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Modele:</b> <?php echo $caracteristiques['ModeleVehicule']; ?></li>
                                            <li class="list-group-item"><b>Marque:</b> <?php echo $caracteristiques['NomMarque']; ?></li>
                                            <li class="list-group-item"><b>Version:</b> <?php echo $caracteristiques['VersionVehicule']; ?></li>
                                            <li class="list-group-item"><b>Année:</b> <?php echo $caracteristiques['AnneeVehicule']; ?></li>
                                            <li class="list-group-item"><b>Moteur:</b> <?php echo $caracteristiques['Moteur']; ?></li>
                                            <li class="list-group-item"><b>Performance:</b> <?php echo $caracteristiques['Performance']; ?></li>
                                            <li class="list-group-item"><b>Dimensions:</b> <?php echo $caracteristiques['Dimensions']; ?></li>
                                            <li class="list-group-item"><b>Puissance:</b> <?php echo $caracteristiques['Puissance']; ?></li>
                                            <li class="list-group-item"><b>Capacité:</b> <?php echo $caracteristiques['Capacite']; ?></li>
                                            <li class="list-group-item"><b>Consommation:</b> <?php echo $caracteristiques['Consommation']; ?></li>
                                            <li class="list-group-item"><b>Tarif:</b> <?php echo $caracteristiques['tarif']; ?></li>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function afficherCaracteristiques($caracteristiques){
        $this->entete_page("Caracteristiques Vehicule");
        $this->menu();
        $this ->logoutButton();
        $this->CaracteristiqueAffich($caracteristiques);
    }

}
?>
