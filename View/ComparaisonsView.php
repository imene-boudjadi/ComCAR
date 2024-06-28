<?php

class ComparaisonsView{
    public function afficherPlusRechComp($Comparaisons)
    {
        foreach ($Comparaisons as $comparaison) {
            ?>
            <div class="container mt-5" >
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card" style="background-color:#CAF0F8;">
                            <div class="card-header" style="background-color:#90E0EF;">
                                <h2 style="text-align: center;">Comparaison <?php echo $comparaison['ModeleVehicule1'] . ' VS ' . $comparaison['ModeleVehicule2']; ?></h2>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <table class="table table-bordered" style="text-align: center; ">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th> <?php echo $comparaison['ModeleVehicule1']?></th>
                                                <th> <?php echo $comparaison['ModeleVehicule2']?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Image du vehicule</b></td>
                                                <td><img src="<?php echo $comparaison['ImageVehicule1']; ?>" alt="Photo vehicule 1" class="img-fluid" style="width:45%; height : 40%;"></td>
                                                <td><img src="<?php echo $comparaison['ImageVehicule2']; ?>" alt="Photo vehicule 2" class="img-fluid" style="width:45%; height : 40%;"></td>                                           
                                            </tr>   
                                            <tr>
                                                <td><b>Modèle</b></td>
                                                <td><?php echo $comparaison['ModeleVehicule1']; ?></td>
                                                <td><?php echo $comparaison['ModeleVehicule2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Marque</b></td>
                                                <td><?php echo $comparaison['NomMarque1']; ?></td>
                                                <td><?php echo $comparaison['NomMarque2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Version</b></td>
                                                <td><?php echo $comparaison['VersionVehicule1']; ?></td>
                                                <td><?php echo $comparaison['VersionVehicule2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Année</b></td>
                                                <td><?php echo $comparaison['AnneeVehicule1']; ?></td>
                                                <td><?php echo $comparaison['AnneeVehicule2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Moteur</b></td>
                                                <td><?php echo $comparaison['Moteur1']; ?></td>
                                                <td><?php echo $comparaison['Moteur2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Performance</b></td>
                                                <td><?php echo $comparaison['Performance1']; ?></td>
                                                <td><?php echo $comparaison['Performance2']; ?></td>
                                            </tr>
                                            <tr>
                                            <td><b>Dimensions</b></td>
                                            <td><?php echo $comparaison['Dimensions1']; ?></td>
                                            <td><?php echo $comparaison['Dimensions2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Puissance</b></td>
                                                <td><?php echo $comparaison['Puissance1']; ?></td>
                                                <td><?php echo $comparaison['Puissance2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Capacité</b></td>
                                                <td><?php echo $comparaison['Capacite1']; ?></td>
                                                <td><?php echo $comparaison['Capacite2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Consommation</b></td>
                                                <td><?php echo $comparaison['Consommation1']; ?></td>
                                                <td><?php echo $comparaison['Consommation2']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Tarif</b></td>
                                                <td><?php echo $comparaison['tarif1']; ?></td>
                                                <td><?php echo $comparaison['tarif2']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
            .row table tr td{
                border-color: #333333;
                border-width: 1px;
            }
            .row table tr th{
                border-color: #333333;
                border-width: 1px;
            }
            </style>

            <?php
        }
    }
}
?>

