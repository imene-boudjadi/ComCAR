


<?php

require_once '../View/Template.php';

class SignupFormView extends Template {
    public function affichUserSignupForm() {
        $this->entetePage("Inscription utilisateur");
        $this->AfficherLogo();
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        ?>
        <body>
            <center>
                <div class="d-flex justify-content-center">
                    <h1 class="mt-5" style="font-size: 40px;">Inscription Utilisateur</h1>
                </div>
            </center>
            <div style="margin-left: 25%; margin-top: 4%; width: 50%; height: 100vh; box-shadow: 0 10px 10px 0; background-color: #FFFFFF;">
                <div id="formContainer">
                    <div class="image">
                        <img src="../Images/logoComCar.png" id="icon" alt="User Icon" style="width: 27%; height: 30%; margin-left: 35%; margin-bottom: 3%; margin-top: 12%;" />
                    </div>
                    <form id="signupForm" method="post" enctype="multipart/form-data">
                        <div class="form-row justify-content-center" style="margin-top:6%;">
                            <div class="form-group col-4">
                                <input required type="text" id="nom" class="form-control" name="nom" placeholder="Nom">
                            </div>
                            <div class="form-group col-4">
                                <input required type="text" id="prenom" class="form-control" name="prenom" placeholder="Prenom">
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-4">
                                <input required type="text" id="username" class="form-control" name="username" placeholder="Username" style="">
                            </div>
                            <div class="form-group col-4">
                                <input required type="email" id="adresse" class="form-control" name="adresse" placeholder="Adresse mail" style="">
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-4">
                                <label for="sexe" class="mr-sm-2" style="margin-left:0%; margin-top:3%;margin-bottom:0%;">Sexe</label>
                                <select required id="sexe" class="inputs custom-select" name="sexe" style="width: 100%; height: 40%; margin-bottom: 3%; margin-left: 0%; margin-top: 5%;">
                                    <option value="" disabled selected>Sexe</option>
                                    <option value="Masculin">Homme</option>
                                    <option value="Feminin">Femme</option>
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="datNaiss" class="mr-sm-2" style="margin-left:0%; margin-top:3%;margin-bottom:-2%;">Date de naissance</label>
                                <input type="date" id="datNaiss" class="inputs custom-select" name="datNaiss" style="width: 100%; height: 40%; margin-bottom: 3%; margin-left: 0%; margin-top: 5%;" required>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-8">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe" style="width: 100%; margin-bottom: 3%; margin-left: 0%;" required>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-8">
                                <label for="photo">Photo</label>
                                <input type="file" id="photo" class="form-control" name="photo" style="width: 100%; margin-bottom: 3%; margin-left: 0%;">
                            </div>
                        </div>
                        <input type="submit" name="submit" id="signupBut" class="btn btn-primary" value="S'inscrire" style="margin-left: 42%; margin-bottom: 3%; margin-top: 2%; width: 18%; height: 13%; background-color: #333333; border-radius: 10%; color: white;">
                    </form>
                    <a href="../routers/login.php" style="margin-left: 25%;">Vous avez déjà un compte ? Connectez-vous.</a>
                </div>
            </div>
        </body>
        <?php
        $this->AffichPiedPage();
        ?>
        <script>
            $(document).ready(function () {
                $("#signupForm").submit(function (event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        url: '../routers/inscription.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            alert(response);
                            if (response =="Inscription reussite, veuillez attendre que l administrateur valide votre inscription pour acceder a votre compte."){
                            window.location.href = '../routers/Accueil.php';
                            }
                        },
                        error: function (xhr, status, error) {
                        console.error(xhr.responseText); 
                }
                    });
                });
            });
        </script>
        <?php
    }
}

?>
