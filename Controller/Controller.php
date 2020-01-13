<?php 

abstract class Controller {

    protected $view;
    protected $model;

    /**
     * Gestion de formulaire de l'ajout
     * @return void
     */

    public function addForm() {
        $this->view->displayForm();
    }

    public function getCategory()
    {
        $requete = "SELECT * FROM category";
        $result = $this->connexion->query($requete);
        $listCats = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($listCats);
        return $listCats;
    }


}