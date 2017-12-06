<?php
    include '../bdd/utilisateurs.php';

    session_start();

    $bdd = connexionbd();
    $requete="SELECT COUNT(*) AS nbr FROM utilisateurs WHERE nom='".$_REQUEST['login']."' AND mdp='".$_REQUEST['mdp']."'";
    $value=requete($bdd,$requete);

    if ($value[0]==0){
        $login = "";
    } else {
        $requete="SELECT nom FROM utilisateurs WHERE nom='".$_REQUEST['login']."' AND mdp='".$_REQUEST['mdp']."'";
        $nom=requete($bdd,$requete);
        $login = $nom['nom'];
        $_SESSION['login'] = $login;
    }

    echo $login;

 ?>
