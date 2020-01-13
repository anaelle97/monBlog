<?php

include 'View/NewView.php';
include 'Model/NewModel.php';


class NewController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new NewView();
      $this->model = new NewModel();
    }

        /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
        $listNews = $this->model->getNews();

        $this->view->displayHome($listNews);
    }

        /**
     * Affichage de l'info 
     *
     * @return void
     */
    public function show()
    {
        $new = $this->model->getNew();
        $this->view->show($new);
    }


    /**
     * Gestion de formulaire de l'ajout
     * @return void
     */

    public function addForm() {
        $listCategories = $this->model->getCategory();
        $this->view->displayForm($listCategories);
    }

        /**
     * Gestion de l'ajout à la table
     * @return void
     */

    public function addDB() {
        $this->model->addDB();
        header('location: index.php?controller=new');
    }

        /**
     * Gestion de la suppression de la DB
     * @return void
     */

    public function suppDB() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur" )){
            $this->model->suppDB();
            header('location: index.php?controller=new');
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }


        /**
     * Mise à jour de l'information 
     * @return void
     */

    public function updateForm() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur" )){
         $new = $this->model->getNew();
         $listCategories = $this->model->getCategory();
         $this->view->updateForm($new, $listCategories); 
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }

          /**
     * Mise à jour de l'information 
     * @return void
     */
    
    public function updateDB() {
        $this->model->updateDB();
        header('location: index.php?controller=new');
    }
}
