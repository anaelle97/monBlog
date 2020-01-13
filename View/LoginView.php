<?php 

class LoginView extends View {

        /**
     * Affichage du formulaire d'identification
     * @return void
     */

    public function formLogin() {
        if (isset($_SESSION['user'])) {
            header ('location:index.php');
        } else {
        $this->page .= "<h2 class='offset-md-2'>Veuillez vous identifier :</h2>";
        $this->page .= file_get_contents('template/formLogin.html');
        $this->page = str_replace('{action}','addDB', $this->page);
        $this->page = str_replace('{username}','', $this->page);
        $this->page = str_replace('{password}','', $this->page);

        $this->displayPage(); 
        }
    }



}