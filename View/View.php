<?php

abstract class View {

/**
* Gestion de l'affichage du head de la page
* @return void
*/

protected $page;

public function __construct(){
$this->page = file_get_contents('template/head.html');
$this->page .= file_get_contents('template/nav.html');
if (isset($_SESSION['user']) && $_SESSION['level'] == "admin") {
    $connexion = "<a class='nav-link text-success' href='index.php?controller=login&action=logout'>Se Déconnecter</a>" ;
    $optionConnect = "<li class='nav-item'>
      <a class='nav-link text-white' href='index.php?controller=category'>Catégories</a>
    </li>
    <li class='nav-item'>
      <a class='nav-link text-white' href='index.php?controller=user'>Utilisateurs</a>
    </li>";
    $utilisateur = "Bienvenu " .$_SESSION['level'] ." !";
} else if (isset($_SESSION['user']) && $_SESSION['level'] == "redacteur") {
    $connexion = "<a class='nav-link text-success' href='index.php?controller=login&action=logout'>Se Déconnecter</a>" ;
    $optionConnect = "<li class='nav-item'>
      <a class='nav-link text-white' href='index.php?controller=category'>Catégories</a>
    </li>";
    $utilisateur = "Bienvenu " .$_SESSION['level'] ." !";
} else if (isset($_SESSION['user'])) {
    $connexion = "<a class='nav-link text-success' href='index.php?controller=login&action=logout'>Se Déconnecter</a>" ;
    $optionConnect = "";
    $utilisateur = "Bienvenu " .$_SESSION['level'] ." !";
} else {
    $connexion = "<a class='nav-link text-success' href='index.php?controller=login&action=formLog'>Se Connecter</a>";
    $optionConnect = "";
    $utilisateur = "";
}

$this->page = str_replace("{connexion}",  $connexion , $this->page);
$this->page = str_replace("{optionConnect}", $optionConnect , $this->page);
$this->page = str_replace("{utilisateur}", $utilisateur , $this->page);

}


/**
* Gestion de l'affichage du footer
* @return void
*/

protected function displayPage() {
$this->page .= file_get_contents('template/footer.html');
echo $this->page;
}

}