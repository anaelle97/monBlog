<?php

class LoginModel extends Model
{
    /**
     * Gestion de la BD dans le tableau
     * @return void
     */

    public function testLogin()
    {
        //var_dump($_POST);
        $username = $_POST['username'];
        $password = $_POST['password'];

        $requete = $this->connexion->prepare("SELECT * FROM user where username = :username AND password = :password");
        $requete->bindParam(':username', $username);
        $requete->bindParam(':password', $password);
        $resultat = $requete->execute();
       // var_dump($resultat);
        $user = $requete->fetch(PDO::FETCH_ASSOC);
        //var_dump($listUsers);
       // var_dump($requete);
        //return $user;
        if ($user != false) {
            header ('location: index.php');
            $_SESSION['user'] = $user;
            $_SESSION['level'] = $username;
        } else {
            header ('location: index.php?controller=login&action=formLog'); }
    }

    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['level']);
    }

}