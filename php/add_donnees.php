<?php
include '../bdd/bdd.php';
$bdd = connexionbd();

$req = $bdd->prepare('INSERT INTO releves VALUES(DEFAULT, :nom_plante, :lieu, :latitude, :longitude, :date_releve, :photo, :nom_collecteur, :prenom_collecteur, :commentaire)');
$req->execute(array(
	'nom_plante' => $_REQUEST['nom_plante'],
	'lieu' => $_REQUEST['lieu'],
    'latitude' => floatval($_REQUEST['latitude']),
    'longitude' => floatval($_REQUEST['longitude']),
    'date_releve' => $_REQUEST['date_releve'],
    'photo' => $_REQUEST['photo'],
    'nom_collecteur' => $_REQUEST['nom_collecteur'],
    'prenom_collecteur' => $_REQUEST['prenom_collecteur'],
    'commentaire' => $_REQUEST['commentaire'],
));

echo http_response_code();

?>
