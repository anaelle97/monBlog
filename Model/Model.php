<?php

abstract class Model {
   const SERVER = "sqlprive-pc2372-001.privatesql.ha.ovh.net:3306";
    const USER = "cefiidev955";
    const PASSWORD = "4qJnkH34";
    const BASE = "cefiidev955"; 

  /* const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BASE = "news"; */


    /**
     * Mise en place de la connexion au serveur
     * @return void
     */

    public function __construct()
    {
        try {
            $this->connexion = new PDO("mysql:host=" . self::SERVER . ";dbname=" . self::BASE . ";charset=UTF8", self::USER, self::PASSWORD);
            $this->connexion->exec("SET NAMES 'UTF8'");
        } catch (Exception $e) {
            echo "Echec de la connexion" . $e->getMessage();
        }
    }

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

    

}