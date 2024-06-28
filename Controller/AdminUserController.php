<?php

require_once('../Model/LoginModel.php');
require_once '../View/AdminUserView.php';

class AdminUserController{

    public function AfficherTableUser(){
        $LoginModel= new LoginModel();
        $users = $LoginModel ->getAllusers();
        $AdminUserView = new AdminUserView();
        $AdminUserView -> AfficherTabUsers($users);
    }

    public function deleteUser($idUserSuppr){
        $LoginModel= new LoginModel();
        $LoginModel -> DeleteUserbyid($idUserSuppr);
    }

    public function bloque($iduser){
        $LoginModel= new LoginModel();
        $rep = $LoginModel -> BloqueUserbyid($iduser);
        return $rep;
    }

    public function debloque($iduser){
        $LoginModel= new LoginModel();
        $rep= $LoginModel -> DeBloqueUserbyid($iduser);
        return $rep;
    }

    public function validerInsc($iduser){
        $LoginModel= new LoginModel();
        $rep= $LoginModel -> ValiderInscrbyid($iduser);
        return $rep;
    }



}

?>