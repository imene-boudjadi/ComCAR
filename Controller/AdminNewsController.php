<?php

require_once('../Model/NewsModel.php');
require_once '../View/AdminNewsView.php';

class AdminNewsController{

    public function AfficherTableNews(){
        $NewsModel= new NewsModel();
        $News = $NewsModel ->getNews();
        $AdminNewsView = new AdminNewsView();
        $AdminNewsView -> AffichTableNews($News);
    }

    public function DeleteNews($idnews){
        $NewsModel= new NewsModel();
        $NewsModel -> DeleteNews($idnews);
    }

    public function getdetails($idnews){
        $NewsModel= new NewsModel();
        $News = $NewsModel -> getDetailsNewsbyid($idnews);
        $AdminNewsView = new AdminNewsView();
        $AdminNewsView -> Afficherdetailsnews($News);
    }

    public function AffichEditForm($idnews){
        $NewsModel = new NewsModel();
        $infos =  $NewsModel -> getDetailsNewsbyid($idnews);
        $AdminNewsView = new AdminNewsView();
        $AdminNewsView-> AfficherEditform($infos);
    }

    public function editNews($idnews,$titre, $contenu,$pathimage){
        $NewsModel = new NewsModel();
        $NewsModel -> modifierNews($idnews,$titre,$contenu,$pathimage);
    }

    public function ModifierdetailsNews($idDetails, $paragraphe, $pathImage){
        $NewsModel = new NewsModel();
        $NewsModel -> modifierDetNews($idDetails,$paragraphe,$pathImage);
    }

    public function getNews($idNews) {
        $newsModel = new NewsModel();
        $news = $newsModel->getNewsById($idNews); 
        return $news;
    }
    

    public function getDetailsNewsById($detailsnewsid) {
        $newsModel = new NewsModel();
        $detNews = $newsModel->getDetNewsbyid($detailsnewsid); 
        return $detNews;
    }
    

}

?>