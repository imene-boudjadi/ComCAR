<?php

require_once '../Model/NewsModel.php';
require_once '../View/NewsView.php';
require_once '../View/DetailsNewsView.php';

class NewsController{
    public function AffichNewsPage(){
        $NewsModel= new NewsModel();
        $news = $NewsModel->getNews();
        $NewsView = new NewsView();
        $NewsView->AfficherNewsPage($news);
    }

    public function AfficherDetailNews($idNews){
        $NewsModel= new NewsModel();
        $Detailsnews = $NewsModel->getDetailsNewsbyid($idNews);
        $DetailsNewsView = new DetailsNewsView();
        $DetailsNewsView->AfficherDetailsNews($Detailsnews);
    }
}

