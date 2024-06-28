<?php 

require_once('../View/pageAdmin.php');

class AdminLoginFormView extends pageAdmin{
    public function LoginForm(){
        ?>
        <body>
        <center>
            <div class="d-flex justify-content-center"><h1 class="mt-5" style="font-size: 40px;"> LogIn Administrateur </h1></div>

            </center>
            <div class="login FormDescend popup" style="position: fixed; z-index: 999999; margin-left : 25%;margin-top:4%;width: 50%; height: 50%;box-shadow: 0 30px 30px 0 rgba(0,0,0,0.3); background-color:#CAF0F8;">
            
            <div id="formContainer">
                    <div class="image">
                        <!-- not yet -->
                        <img src="../Images/logoComCar.png" id="icon" alt="User Icon" style="width: 27%; height: 30%; margin-left: 37%; margin-bottom: 3%; margin-top: 40px;" />
                    </div>
                    <form action="../routers/admin.php" method="post"> 
                        <input required type="text" id="adresse" class="adresse" name="adresse" placeholder="Adresse mail" style="width: 60%; height: 30%;margin-bottom:3%;margin-left:20%;">
                        <input  type="password" id="password" class="password" name="password" placeholder="mot de passe" style="width: 60%;margin-bottom:3%;margin-left:20%;">
                        <input type="submit" name="submit" class="submit" value="Log In" style="margin-left: 42%;margin-top:2%;width:18%;height:13%;background-color:#333333;border-radius:10%;color:white;">
                    </form>
                </div> 
            </div>
    </body>
        <?php
    }


    public function AfficheFormAdmin(){ 
        $this->entete_page("Login Admin");
        $this->LoginForm();
    }
}
 

?>