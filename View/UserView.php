<?php 


class UserView extends View {

        /**
     * Gestion de l'affichage du tableau
     * @return void
     */

    public function displayHome($listUsers) {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin")){
            $this->page .="<h1 class='text-center'>Les différentes Utilisateurs !</h1>";
            $this->page .= "<p><a class='btn btn-success col-12 mt-3 p-2 mb-4' href='index.php?controller=user&action=addForm'>Ajouter</a></p>";
            $this->page .= "<table class='table text-center col p-2 mt-2 mb-4'>";
            $this->page .= "<thead class='thead-light'><th>Username</th><th>Password</th><th>Nom</th><th>Prénom</th><th>Supprimer</th><th>Modifier</th></thead>";
            foreach ($listUsers as $users) {
                $this->page .= "<tr><td>" .$users['username'] 
                ."</td><td class=''>" .$users['password']
                ."</td><td class=''>" .$users['firstname']
                ."</td><td class=''>" .$users['lastname']
                ."</td><td><a class='btn btn-danger' href='index.php?controller=user&action=suppDB&id="
                .$users['id']
                ."'><i class='fas fa-trash-alt'></i></a></td><td><a class='btn btn-primary' href='index.php?controller=user&action=updateForm&id="
                .$users['id']
            ."'><i class='fas fa-edit'></i></a></td></tr>";
            }
            $this->page .= "</table>";
            $this->displayPage();
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }

        /**
     * Gestion de l'affichage du formulaire pour ajouter
     * @return void
     */

    public function displayForm() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin")){
            $this->page .= "<h2>J'ajoute un utilisateur via un formulaire :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=user&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formUser.html');
            $this->page = str_replace('{action}','addDB', $this->page);
            $this->page = str_replace('{id}','', $this->page);
            $this->page = str_replace('{username}','', $this->page);
            $this->page = str_replace('{password}','', $this->page);
            $this->page = str_replace('{firstname}','', $this->page);
            $this->page = str_replace('{lastname}','', $this->page);
            $this->displayPage();
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }

        /**
     * Gestion du formulaire pour modifier une information
     * @return void
     */

     
    public function updateForm($user) {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur")){
            $this->page .= "<h2>Modification de l'Utilisateur :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=user&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formUser.html');
            $this->page = str_replace('{action}','updateDB', $this->page);
            $this->page = str_replace('{id}',"<label class='d-none' for='id'>ID : </label>
            <input class='form-control d-none' id='id' type='text' name='id' value='" .$user['id'] ."' readonly><br>", $this->page);
            $this->page = str_replace('{username}',$user['username'], $this->page);
            $this->page = str_replace('{password}',$user['password'], $this->page);
            $this->page = str_replace('{firstname}',$user['firstname'], $this->page);
            $this->page = str_replace('{lastname}',$user['lastname'], $this->page);

            $this->displayPage();
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }

}
