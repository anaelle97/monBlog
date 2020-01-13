<?php

include 'View/CategoryView.php';
include 'Model/CategoryModel.php';

class CategoryController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new CategoryView();
      $this->model = new CategoryModel();
    }

        /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
        $listCats = $this->model->getCategory();

        $this->view->displayHome($listCats);
    }

        /**
     * Gestion de l'ajout à la table
     * @return void
     */

    public function addDB() {
        $this->model->addDB();
        header('location: index.php?controller=category');
    }

        /**
     * Gestion de la suppression de la DB
     * @return void
     */

    public function suppDB() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] !== "admin" || $_SESSION['level'] !== "redacteur")){
            $this->model->suppDB();
            header('location: index.php?controller=category');
        } else {
            header('location:index.php?controller=login&action=formLog');
        }
    }

        /**
     * Mise à jour de l'information 
     * @return void
     */

    public function updateForm() {
         $cat = $this->model->getCat();
         $this->view->updateForm($cat);
    }

          /**
     * Mise à jour de l'information 
     * @return void
     */
    
    public function updateDB() {
        $this->model->updateDB();
        header('location: index.php?controller=category');
    }

}