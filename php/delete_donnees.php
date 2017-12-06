<?php
session_start();

include '../bdd/bdd.php';
if (isset($_SESSION['login'])){ // Si l utilisateur est authentifie il peut supprimer
    $bdd = connexionbd();

    $req = $bdd->prepare('DELETE FROM releves WHERE id=:id');
    $req->execute(array(
	       'id' => $_REQUEST['id_do'], // id_do ? 
       ));
    echo "Suppression effectuée";

} else { // Sinon on il ne peut pas le faire
    echo "Vous n'êtes pas authentifié(e)";
}
?>
