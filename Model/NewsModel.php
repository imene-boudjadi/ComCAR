<?php

require_once '../Controller/dbController.php';

class NewsModel{
    public function getNews(){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $news = $db->request($pdo,'SELECT * FROM News');
            $db->disconnect($pdo);
            return $news;
        } catch (Exception $e) {
            echo "erruer dans getNews";
        }
    }

    public function getDetailsNewsbyid($idNews){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM DetailsNews LEFT JOIN News ON DetailsNews.Codenews = News.idNews WHERE News.idNews =:id_news");
            $query->bindParam(':id_news', $idNews, PDO::PARAM_INT);
            $query->execute();
            $Detailsnews = $query->fetchAll(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $Detailsnews;
        } catch(Exception $e){
            echo "Problem dans getdetailsNewsbyId";
        }
    } 

    public function getNewsById($idNews) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM News WHERE idNews = :id_news");
            $query->bindParam(':id_news', $idNews, PDO::PARAM_INT);
            $query->execute();
            $news = $query->fetch(PDO::FETCH_ASSOC);
            $db->disconnect($pdo);
            echo "Model: ";
            echo $news['ImageNews'];
    
            return $news;
        } catch (Exception $e) {
            echo "erreur dans getNewsById ";
        }
    }
    
    public function getDetNewsbyid($detailsnewsid) {
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM DetailsNews WHERE idDetailsNews = :detailsnewsid");
            $query->bindParam(':detailsnewsid', $detailsnewsid, PDO::PARAM_INT);
            $query->execute();
            $detailsNews = $query->fetch(PDO::FETCH_ASSOC); 
            $db->disconnect($pdo);
            return $detailsNews;
        } catch(Exception $e) {
            echo "Problème dans getDetNewsById : " . $e->getMessage();
        }
    }
    

    public function DeleteNews($idnews){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("DELETE FROM DetailsNews WHERE Codenews = :idnews");
            $query->bindParam(':idnews', $idnews, PDO::PARAM_INT);
            $query->execute();
            $delquery = $pdo->prepare("DELETE FROM News WHERE idNews = :idnews");
            $delquery->bindParam(':idnews', $idnews, PDO::PARAM_INT);
            $delquery->execute();
            $db->disconnect($pdo);
        } catch(Exception $e){
            echo "Problem dans deletenews";
        }
    }

    public function modifierNews($idnews,$titre,$contenu,$pathimage){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $query = $pdo->prepare("SELECT * FROM News WHERE TiteNews = :titre AND idNews != :idnews");
            $query->bindParam(':titre', $titre, PDO::PARAM_STR);
            $query->bindParam(':idnews', $idnews, PDO::PARAM_INT);
            $query->execute();
            $news = $query->fetchAll(PDO::FETCH_ASSOC);    
            if(!$news){
                $ModQuery = $pdo->prepare("UPDATE News SET TiteNews = :titre, ContenuNews = :contenu, ImageNews = :pathimage WHERE idNews = :idnews");
                $ModQuery->bindParam(':idnews', $idnews, PDO::PARAM_INT);
                $ModQuery->bindParam(':titre', $titre, PDO::PARAM_STR);
                $ModQuery->bindParam(':contenu', $contenu, PDO::PARAM_STR);
                $ModQuery->bindParam(':pathimage', $pathimage, PDO::PARAM_STR);
                $ModQuery->execute();
            }else{
                echo "erreur, titre de news existe deja";
            }
            $db->disconnect($pdo);
        } catch(Exception $e){
            echo "Problem dans modifierNews";
        }
    }

    public function modifierDetNews($idDetails,$paragraphe,$pathImage){
        try {
            $db = new dbController();
            $pdo = $db->connect();
            $ModQuery = $pdo->prepare("UPDATE DetailsNews SET ParagrapheNews = :paragraphe, ImageDetailsNews = :imagepath WHERE idDetailsNews = :idDetnews");
            $ModQuery->bindParam(':idDetnews', $idDetails, PDO::PARAM_INT);
            $ModQuery->bindParam(':paragraphe', $paragraphe, PDO::PARAM_STR);
            $ModQuery->bindParam(':imagepath', $pathImage, PDO::PARAM_STR);
            $ModQuery->execute();
            $db->disconnect($pdo);
        } catch(Exception $e){
            echo "Problem dans modifierDetNews";
        }
    }
}

?>