<?php

include 'View/UserView.php';
include 'Model/UserModel.php';

class UserController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new UserView();
      $this->model = new UserModel();
    }

        /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
        $listUsers = $this->model->getUser();

        $this->view->displayHome($listUsers);
    }

        /**
     * Gestion de l'ajout à la table
     * @return void
     */

    public function addDB() {
        $this->model->addDB();
        header('location: index.php?controller=user');
    }

        /**
     * Gestion de la suppression de la DB
     * @return void
     */

    public function suppDB() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin")){
            $this->model->suppDB();
            header('location: index.php?controller=user');
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }


        /**
     * Mise à jour de l'information 
     * @return void
     */

    public function updateForm() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin")){
            $user = $this->model->getUse();
            $this->view->updateForm($user);
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }

          /**
     * Mise à jour de l'information 
     * @return void
     */
    
    public function updateDB() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin")){
            $this->model->updateDB();
            header('location: index.php?controller=user');
        }
    }

}