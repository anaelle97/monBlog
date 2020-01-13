<?php

class UserModel extends Model
{

    /**
     * Gestion de la BD dans le tableau
     * @return void
     */

    public function getUser()
    {
        $requete = "SELECT * FROM user";
        $result = $this->connexion->query($requete);
        $listUsers = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($listUsers);
        return $listUsers;
    }

    /**
     * Gestion de l'ajout d'informations dans la BD
     * @return void
     */

    public function addDB()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];


        $requete = $this->connexion->prepare("INSERT INTO `user`(`id`, `username`, `password`, `firstname`, `lastname`) 
        VALUES (NULL, :username, :password, :firstname, :lastname)");
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':firstname', $firstname);
        $requete->bindParam(':lastname', $lastname);
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

        $requete = $this->connexion->prepare("DELETE FROM user WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
    }

    /**
     * Gestion d'une modification de la BD
     * @return void
     */

    public function getUse()
    {
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT * FROM user WHERE id = :id");
        $requete->bindParam(':id', $id);
        $resultat = $requete->execute();
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public function updateDB()
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $requete = $this->connexion->prepare("UPDATE  `user` SET username = :username, password = :password, firstname = :firstname, lastname = :lastname WHERE id = :id");
        $requete->bindParam(':id', $id);
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':firstname', $firstname);
        $requete->bindParam(':lastname', $lastname);
        $resultat = $requete->execute();
    }
}
