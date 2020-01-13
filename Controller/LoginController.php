<?php

include 'View/LoginView.php';
include 'Model/LoginModel.php';

class LoginController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new LoginView();
      $this->model = new LoginModel();
    }

    public function login() {
        $user = $this->model->testLogin();
    }

    public function formLog() {
        $this->view->formLogin();
    }

    
           /**
     * Deconnexion 
     * @return void
     */

    public function logout() {
        $this->model->logout();
    header ('location:index.php?controller=new');
    }

}