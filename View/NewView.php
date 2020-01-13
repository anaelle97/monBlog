<?php 

class NewView extends View {

        /**
     * Gestion de l'affichage du tableau
     * @return void
     */

    public function displayHome($listNews) {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur") ) {
            $boutonajout = "<p><a class='btn btn-success col-12 mt-3 p-2' href='index.php?controller=new&action=addForm'>Ajouter</a></p>";
            $tableau = "<th>Voir l'article</th><th>Modifier</th><th>Supprimer</th>";
        } else {
            $boutonajout = "";
            $tableau ="<th>Voir l'article</th>";
        }
        

        $this->page .="<h1 class='text-center'>Les Informations !</h1>";
        $this->page .= $boutonajout;
        $this->page .= "<table class='table text-center col p-2'>";
        $this->page .= "<thead class='thead-light'><th>Titre</th><th>Catégories</th><th>Description</th>" .$tableau ."</thead>";
        ;
        foreach ($listNews as $news) {
            if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur")) {
                $boutonsupp = "</td><td><a class='btn btn-danger' href='index.php?controller=new&action=suppDB&id=" .$news['newsid'] ."'><i class='fas fa-trash-alt'></i></a>";
                $boutonmodif ="</td><td><a class='btn btn-primary' href='index.php?controller=new&action=updateForm&id="  .$news['newsid'] ."'><i class='fas fa-edit'></i></a>" ;
                $boutonvoir = "</td><td><a class='btn btn-warning' href='index.php?controller=new&action=show&id=" .$news['newsid'] ."'><i class='fas fa-eye'></i></a></td>";
            } else {
                $boutonsupp = "";
                $boutonmodif = "";
                $boutonvoir = "</td><td><a class='btn btn-warning' href='index.php?controller=new&action=show&id=" .$news['newsid'] ."'><i class='fas fa-eye'></i></a></td></tr>";
            };

            $description = (strlen($news['Newsdescription'])>50)?substr($news['Newsdescription'],0,70)." [...]":$news['Newsdescription'];
            $this->page .= "<tr><td>" .$news['title']
            ."</td><td>" .$news['name']
            ."</td><td>" .$description
            .$boutonvoir 
            .$boutonmodif
            .$boutonsupp
            ."</tr>" ;
        }
        $this->page .= "</table>";
        $this->displayPage();
    }

     /**
     * Affichage de l'info
     *
     * @param array $new
     * @return void
     */
    public function show($new)
    {
        if (isset($_SESSION['user'])) {
         $this->page .= "<div class='card text-center mt-5 mb-2'>
                            <div class='card-header bg-dark text-white'><h2 class='mt-1'>Détail de l'info</h2></div>
                            <div class='card-body'>
                            <h5 class='card-title'>" .$new['title']."</h5>
                            <p class='card-text text-justify'>" .nl2br($new['description']) ."</p>
                            </div>
                        </div>
                        <a href='index.php' class='btn btn-primary col-12 mt-4'>Retour à la liste</a> ";

        $this->displayPage();
    } else {
        header ('location:index.php?controller=login&action=formLog');
    }
    }

        /**
     * Gestion de l'affichage du formulaire pour ajouter
     * @return void
     */

    public function displayForm($listCategories) {
        if (isset($_SESSION['user']) && $_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur"){
            $this->page .= "<h2>J'ajoute une info via un formulaire :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=new&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formNew.html');
            $this->page = str_replace('{action}','addDB', $this->page);
            $this->page = str_replace('{id}',"", $this->page);
            $this->page = str_replace('{title}','', $this->page);
            $this->page = str_replace('{description}','', $this->page);
            $categories = "";
            foreach($listCategories as $category) {
                $categories .= "<option value='" .$category['id'] ."'>" .$category['name'] ."</option>";
            }
            $this->page = str_replace('{categories}',$categories, $this->page);
            $this->displayPage();
        } else {
            header ('location:index.php?controller=login&action=formLog');
        }
    }
        /**
     * Gestion du formulaire pour modifier une information
     * @return void
     */

    public function updateForm($new, $listCategories) {
        if (isset($_SESSION['user']) && ($_SESSION['level'] == "admin" || $_SESSION['level'] == "redacteur")){
            $this->page .= "<h2>Modification de l'information :</h2>";
            $this->page .= "<a class='btn btn-primary col-12 mt-3' href='index.php?controller=new&action=start'>Retour en arrière</a>";
            $this->page .= file_get_contents('template/formNew.html');
            $this->page = str_replace('{action}','updateDB', $this->page);
            $this->page = str_replace('{id}',"<label class='d-none' for='id'>ID : </label>
            <input class='form-control d-none' id='id' type='text' name='id' value='" .$new['id'] ."' readonly><br>", $this->page);
            $this->page = str_replace('{title}',$new['title'], $this->page);
            $this->page = str_replace('{description}',$new['description'], $this->page);
            $categories = "";
            foreach($listCategories as $category) {
                $selected = "";
                if ($new['category'] == $category['id']) {
                    $selected = "selected";
                }
                $categories .= "<option $selected value='" .$category['id'] ."'>" .$category['name'] ."</option>";
            }
            $this->page = str_replace('{categories}',$categories, $this->page);
            $this->displayPage();
            } else {
            header ('location:index.php?controller=login&action=formLog');

    }
    }

}