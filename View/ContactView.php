<?php

require_once('../View/Template.php');

class ContactView extends Template{ 
    // les classes a verifierrrr

    public function InfosContact(){
    ?>

        <div class="mb-5 position-relative ">
        <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 50px; margin-top:-10%;color:#8D6A9F">Contactez nous </h1></div>

            <!-- <img src="/ProjetWeb/public/images/contactBg.jpg" width="100%" height="100%" class="rounded-4 opacity-25 d-block mx-auto position-absolute bottom-0" /> -->
            <!-- <div  style = "background-color:#EEEEEE; max-width:85%; margin-left:5%;border:1px solid black"> -->
            <div class="d-flex justify-content-between pt-5 px-4 position-relative" style = "background-color:#EEEEEE; max-width:70%; margin-left:13%;border:1px solid black;margin-top:2%;">
            <div class="col-4" style="margin-left:15%;margin-top:1%;">
                    <!-- <div class="h1 text-center pt-3 " style="color:#8D6A9F">Nos Informations</div> -->
                    <div class="text-center ">Si vous avez des questions, des problèmes ou des suggestions, n'hésitez pas à nous contacter par e-mail, via nos réseaux sociaux ou par téléphone.</div>
                </div>
                <div class="col-4 pb-2" style="margin-right:10%; margin-top:-2%;margin-bottom:4%;">
                    <!-- <div><img src="/ProjetWeb/public/logos/logo.png" width="60%" class="d-block mx-auto mb-3" /></div> -->
                    <div><img src="../Images/logotest.png" width="60%" class="d-block mx-auto"  style="margin-bottom:5%;width:40%;height:40%;"/></div>
                    <div class="d-flex justify-content-center" style="margin-bottom:2%;">
                        <a href="tel:0611121314" style="text-decoration-none; color:#333333;">+213 6 12 13 14 15</a> <!-- not a real number tho -->
                    </div>
                    <div class=" d-flex justify-content-center" style="margin-bottom:2%;">
                        <a href="tel:0716171819" style=" text-decoration-none; color:#333333;">+213 7 16 17 18 19</a> <!-- same here -->
                    </div>
                    <div class="h6 d-flex justify-content-center" style="margin-bottom:2%;">
                        <a href="mailto:ki_boudjadi@esi.dz" style=" text-decoration-none; color:#333333;" >ki_boudjadi@esi.dz</a>
                    </div>


                </div>
                
            </div>
        </div>
    <?php
    }


    public function AfficherContactPage(){
        $this->entetePage("Contact");
        $this->AfficherLogo();
        if (session_status() == PHP_SESSION_ACTIVE and $_SESSION != [] ){
            $this->profilButton();
            $this->logoutButton();
        }
        else{
            $this->afficherLoginButton();
        }
        $this->AfficherReseauxSociaux();
        $this->AffichMenu();
        $this->InfosContact();
        // contact form
        // $this->contactForm();
        $this->AffichPiedPage();
    }
}

?>