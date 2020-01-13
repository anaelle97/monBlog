<?php

class NewModel extends Model
{

    /**
     * Gestion de la BD dans le tableau
     * @return void
     */

    public function getNews()
    {
        $requete = "SELECT *,news.description AS Newsdescription ,news.id as newsid FROM `news` JOIN `category` ON news.category = category.id order by newsid";
        //$requete = "SELECT * FROM news";
        $result = $this->connexion->query($requete);
        $listNews = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($listNews);
        return $listNews;
    }

    /**
     * Gestion de l'ajout d'informations dans la BD
     * @return void
     */

    public function addDB()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        $requete = $this->connexion->prepare("INSERT INTO `news`(`id`, `title`, `description`, `category`) 
        VALUES (NULL, :title, :description, :category)");
        $requete->bindParam(':title', $title);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':category', $category);
        $resultat = $requete->execute();
       // var_dump($resultat);
    }

    /**
     * Gestion d'une suppression dans la BD
     * @return void
     */

    public function suppDB()
    {
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM news WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
    }

    /**
     * Gestion d'une modification de la BD
     * @return void
     */

    public function getNew()
    {
        $id = $_GET['id'];
        //$requete = $this->connexion->prepare("SELECT news.*, category.id AS id_category ,category_description as description_category FROM `news` JOIN `category` ON news.category = category.id WHERE id = :id");
        $requete = $this->connexion->prepare("SELECT * FROM news WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $new = $requete->fetch(PDO::FETCH_ASSOC);
       // var_dump($new);
      //  var_dump($requete->errorInfo());
        return $new;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $requete = $this->connexion->prepare("UPDATE `news` SET title = :title, description = :description, category = :category WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':title', $title);
        $requete->bindParam(':description', $description);
        $requete->bindParam(':category', $category);
        $resultat = $requete->execute();
      //  var_dump($resultat);
        //var_dump($requete);
       // var_dump($_POST);
    }
}
