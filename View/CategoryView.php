<?php 


class CategoryView extends View {

        /**
     * Gestion de l'affichage du tableau
     * @return void
     */

    public function displayHome($listCats) {

        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur") ) {
            $ajout = "<p><a class='btn btn-success col-12 mt-3 p-2' href='index.php?controller=category&action=addForm'>Ajouter</a></p>";
            $modifier = "<th>Supprimer</th><th>Modifier</th>";
            $bouton = "</td><td><a class='btn btn-danger' href='index.php?controller=category&action=suppDB&id=";
            $bouton2 ="'><i class='fas fa-trash-alt'></i></a></td><td><a class='btn btn-primary' href='index.php?controller=category&action=updateForm&id=";
            $bouton3 = "'><i class='fas fa-edit'></i></a></td>";
        } else if(isset($_SESSION['user']) && $_SESSION['level'] == "redacteur"){
            $ajout = "<p><a class='btn btn-success col-12 mt-3 p-2' href='index.php?controller=category&action=addForm'>Ajouter</a></p>";
            $modifier ="<th>Modifier</th>";
            $bouton = "<!--";
            $bouton2 = "--></td><td><a class='btn btn-primary' href='index.php?controller=category&action=updateForm&id=";
            $bouton3 = "'><i class='fas fa-edit'></i></a></td>";
        } else {
            $ajout = "";
            $modifier = "";
            $bouton = "<!--";
            $bouton2 = "";
            $bouton3 = "-->";
        }

        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur") ) {
        $this->page .="<h1 class='text-center'>Les différentes Catégories !</h1>";
        $this->page .= $ajout;
        $this->page .= "<table class='table text-center col p-2'>";
        $this->page .= "<thead class='thead-light'><th>Nom</th><th class=''>Description</th>" .$modifier ."</thead>";
        foreach ($listCats as $cats) {
            $this->page .= "<tr><td>" .$cats['name'] 
            ."</td><td class=''>" .$cats['description']
            .$bouton .$cats['id'] .$bouton2 .$cats['id'] .$bouton3 ."</tr>";
        }
        $this->page .= "</table>";
        $this->displayPage();
        } else {
            header('location:index.php?controller=login&action=formLog');
        }
    }
        /**
     * Gestion de l'affichage du formulaire pour ajouter
     * @return void
     */

    public function displayForm() {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur") ) {
            $this->page .= "<h2>J'ajoute une info via un formulaire :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=category&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formCategory.html');
            $this->page = str_replace('{action}','addDB', $this->page);
            $this->page = str_replace('{id}','', $this->page);
            $this->page = str_replace('{name}','', $this->page);
            $this->page = str_replace('{description}','', $this->page);

            $this->displayPage();
        } else {
            header('location:index.php?controller=login&action=formLog');
        }
    }

        /**
     * Gestion du formulaire pour modifier une information
     * @return void
     */

     
    public function updateForm($cat) {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur") ) {
            $this->page .= "<h2>Modification de l'information :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=category&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formCategory.html');
            $this->page = str_replace('{action}','updateDB', $this->page);
            $this->page = str_replace('{id}',"<label class='d-none' for='id'>ID : </label>
            <input class='form-control d-none' id='id' type='text' name='id' value='" .$cat['id'] ."' readonly><br>", $this->page);
            $this->page = str_replace('{name}',$cat['name'], $this->page);
            $this->page = str_replace('{description}',$cat['description'], $this->page);
            $this->displayPage();

        } else {
            header('location:index.php?controller=login&action=formLog');
        }
    }

    }


