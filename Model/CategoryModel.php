<?php

class CategoryModel extends Model
{

    /**
     * Gestion de la BD dans le tableau
     * @return void
     */

    public function getCategory()
    {
        $requete = "SELECT * FROM category";
        $result = $this->connexion->query($requete);
        $listCats = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($listCats);
        return $listCats;
    }

    /**
     * Gestion de l'ajout d'informations dans la BD
     * @return void
     */

    public function addDB()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];


        $requete = $this->connexion->prepare("INSERT INTO `category`(`id`, `name`, `description`) 
        VALUES (NULL, :name, :description)");
        $requete->bindParam(':name', $name);
        $requete->bindParam(':description', $description);
        $resultat = $requete->execute();
    }

    /**
     * Gestion d'une suppression dans la BD
     * @return void
     */

    public function suppDB()
    {
        $id = $_GET['id'];

        $requete = $this->connexion->prepare("DELETE FROM category WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
    }

    /**
     * Gestion d'une modification de la BD
     * @return void
     */

    public function getCat()
    {
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT * FROM category WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $cat = $requete->fetch(PDO::FETCH_ASSOC);
        return $cat;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $requete = $this->connexion->prepare("UPDATE  `category` SET name = :name, description = :description WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':name', $name);
        $requete->bindParam(':description', $description);
        $resultat = $requete->execute();
    }
}
