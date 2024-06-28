<?php

require_once '../View/Template.php';

class UserLoginFormView extends Template{
    public function AfficheFormLogin(){
        $this->entetePage("login user");
        $this->AfficherLogo();
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        ?>
        <body>
        <center>
            <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;"> Authentification Utilisateur </h1></div>

            </center>
            <div style=" margin-left : 25%;margin-top:4%;width: 50%; height: 50vh;box-shadow: 0 10px 10px 0 ; background-color:#FFFFFF;">
            
            <div id="formContainer">
                    <div class="image">
                        <!-- not yet -->
                        <img src="../Images/logoComCar.png" id="icon" alt="User Icon" style="width: 27%; height: 30%; margin-left: 36%; margin-bottom: 3%; margin-top: 25px;" />
                    </div>
                    <form id="loginF" method="post"> 
                        <input required type="text" id="adresse" class="form-control" name="adresse" placeholder="Adresse mail ou username" style="width: 60%; height: 30%;margin-bottom:3%;margin-left:20%;margin-top:5%;">
                        <input  type="password" id="password" class="form-control" name="password" placeholder="mot de passe" style="width: 60%;margin-bottom:3%;margin-left:20%;">
                        <input type="submit" name="submit" class="submit" value="Log In" style="margin-left: 42%;margin-bottom:3%;margin-top:2%;width:18%;height:13%;background-color:#333333;border-radius:10%;color:white;">
                    </form>
                    <a href="../routers/inscription.php" style="margin-left : 28%;">Vous n'avez pas de compte ? S'inscrire.</a>
                </div> 
            </div>
    </body>
    <script>
            $(document).ready(function () {
                $("#loginF").submit(function (event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        url: '../routers/login.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response =="login reussit"){
                            window.location.href = '../routers/Accueil.php';
                            }else{
                                alert(response);
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
                $this->AffichPiedPage();
    }
}

?>