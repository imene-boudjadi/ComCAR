<?php
require_once('../View/pageAdmin.php');

class AdminAcceilview  extends pageAdmin {

    public function AdminAcceuil(){  
            ?>
            
     <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;">Section administrateur </h1></div>
     <center>
     <div class="row m-5 mx-auto justify-content-center">
      <div class="col-sm-3">
        <div class="card h-100" style="height:fit-content;">
          <div class="card-body">
            <h5 class="card-title"style="font-size: 20px;">Gestion des Véhicules</h5>
            <p class="card-text" style="font-size: 15;">Gérez les différents marques ainsi que les véhicules associées et leurs caractéristiques. </p>
            <a href="../routers/AdminGestionVehicule.php" class="btn btn-primary" style="background-color:#90E0EF;margin-left: 9%;">
              <img src="../Images/ibiza.jpeg" alt="Entrer" width="180" height="150">
            </a>
            </a>
          </div>
        </div>
      </div>
   
      <div class="col-sm-3">
        <div class="card h-100" style="height:fit-content;">
          <div class="card-body" >
            <h5 class="card-title"style="font-size: 20px;">Gestion des Avis</h5>
            <p class="card-text" style="font-size: 15;">Gérez les avis des utilisateurs en les validant ou en les supprimant.</p>
            <a href="../routers/AdminAvisGestion.php" class="btn btn-primary" style="background-color:#90E0EF;margin-left: 9%;">
              <img src="../Images/avis.jpeg" alt="Entrer" width="180" height="150">
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="card h-100" style="height:fit-content;">
          <div class="card-body">
            <h5 class="card-title"style="font-size: 20px;">Gestion des News</h5>
            <p class="card-text" style="font-size: 15;">Ajoutez et gérez les actualités destinées à être affichées aux utilisateurs.</p>
            <a href="../routers/AdminGestionNews.php" class="btn btn-primary" style="background-color:#90E0EF;margin-left: 9%;">
              <img src="../Images/news.jpeg" alt="Entrer" width="180" height="150">
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row m-5 mx-auto justify-content-center">

      <div class="col-sm-3" >
        <div class="card h-100" style="height:fit-content;">
          <div class="card-body">
            <h5 class="card-title"style="font-size: 20px;">Gestion des utilisateurs</h5>
            <p class="card-text" style="font-size: 15;">Gérez les utilisateurs en validant leurs inscriptions ou en les bloquant.</p>
            <a href="../routers/AdminGestionUser.php" class="btn btn-primary" style="background-color:#90E0EF;margin-left: 9%;">
              <img src="../Images/userGest.jpeg" alt="Entrer" width="180" height="150">
            </a>
          </div>
        </div>
      </div>
      <div class="col-sm-3" >
        <div class="card h-100" style="height:fit-content;">
          <div class="card-body">
            <h5 class="card-title"style="font-size: 20px;">Paramètres</h5>
            <p class="card-text" style="font-size: 15;">Gérez les différentes options du diaporama, du guide d'achat et du style de la page. </p>
            <a href="#" class="btn btn-primary" style="background-color:#90E0EF;margin-left: 9%;">
              <img src="../Images/params.jpeg" alt="Entrer" width="180" height="150">
            </a>
          </div>
        </div>
      </div>
    </div>

          
    </center>
    <?php
    
        }

        public function afficherAdminAcceuil(){ 
            $this->entete_page("Section Administrateur"); 
            $this->menu();
            $this ->logoutButton();
            $this->AdminAcceuil();
        }
     
    }

?>
