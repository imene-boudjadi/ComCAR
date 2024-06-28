<?php 

require_once('../Controller/ComparateurController.php');

class DetailsVehView{
    
    public function afficherPlusRechCompveh($DetailsVehView){
        if($DetailsVehView){
            $ComparateurController = new ComparateurController();
        ?>
        <div class="card-header" style="background-color:#90E0EF; max-width:85%;margin-left:7.5%;">
            <h2 style="text-align: center;">Les comparaisons les plus recherchées du véhicule </h2>
        </div>

            <?php
        foreach ($DetailsVehView as $Detail){
            // nb vehicules a afficher -- car it can be 2, 3 or 4
            $nbVehicules = count($Detail);
            $entetes = [''];
            foreach ($Detail as $vehicule) {
                $entetes[] = $vehicule['ModeleVehicule'];
            }
    ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div style="background-color:#CAF0F8;" style="max-width:100%;">
                <!-- <div class="card-header" style="background-color:#90E0EF;">
                    <h2 style="text-align: center;">Tableau comparateur</h2>
                </div> -->
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered" style="text-align: center;">
                            <thead>
                                <tr>
                                    <?php foreach ($entetes as $entete): ?> <!-- heads du tableau -->
                                        <th><?php echo $entete; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Detail as $key => $vehicule): ?>
                                    <?php if($key === 0 ){  ?>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Image du véhicule' : ''; ?></b></td> <!-- une seule fois -- first iteration  -->
                                        <?php foreach ($Detail as $veh): ?>
                                            <td>
                                                <a href="../routers/Comparateur.php?id_vehicule=<?= $veh['idVehicule']; ?>">
                                                    <img src="<?php echo $veh['ImageVehicule']; ?>" alt="Photo vehicule" class="img-fluid" style="width:45%; height: 40%;">
                                                </a>  
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Modèle' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['ModeleVehicule']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Marque' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['NomMarque']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Version' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['VersionVehicule']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Année' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['AnneeVehicule']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Moteur' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Moteur']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Performance' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Performance']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Dimensions' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Dimensions']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Puissance' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Puissance']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Capacite' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Capacite']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Consommation' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['Consommation']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'tarif' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php echo $veh['tarif']; ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <td><b><?php echo $key == 0 ? 'Note' : ''; ?></b></td>
                                        <?php foreach ($Detail as $veh): ?>
                                            <td><?php 
                                                $note = $ComparateurController->getNote($veh['idVehicule']);
                                                echo $note;
                                                echo "/5";
                                                ?> 
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
        .row table tr td {
            border-color: #333333;
            border-width: 1px;
        }
        .row table tr th {
            border-color: #333333;
            border-width: 1px;
        }
    </style>
<?php
        }
    }
}
}


?>