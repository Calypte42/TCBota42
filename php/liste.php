<?php
    include '../bdd/bdd.php';
    $bdd = connexionbd();
    $data = Array("releves" => Array());
    if ($_REQUEST['recherche']==''){
        $query = $bdd->query('SELECT * FROM releves ORDER BY id');
        while ($donnees = $query->fetch()) {
            $data['releves'][] = Array('id'=>$donnees['id'], 'nom_plante'=>$donnees['nom_plante'],'lieu'=>$donnees['lieu'],'latitude'=>$donnees['latitude'],'longitude'=>$donnees['longitude'],'date_releve'=>$donnees['date_releve'],'photo'=>$donnees['photo'],'nom_collecteur'=>$donnees['nom_collecteur'],'prenom_collecteur'=>$donnees['prenom_collecteur'],'commentaire'=>$donnees['commentaire']);
        }
        header("Content-Type:application/json");
        echo json_encode($data);
    }else{
        $requete = "SELECT * FROM releves WHERE id LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR nom_plante LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR lieu LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR latitude LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR longitude LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR date_releve LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR nom_collecteur LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR prenom_collecteur LIKE '%". $_REQUEST['recherche'] ."%'
                                            OR commentaire LIKE '%". $_REQUEST['recherche'] ."%' ORDER BY id";
        $query = $bdd->query($requete);

        while ($donnees = $query->fetch()) {
            $data['releves'][] = Array('id'=>$donnees['id'], 'nom_plante'=>$donnees['nom_plante'],'lieu'=>$donnees['lieu'],'latitude'=>$donnees['latitude'],'longitude'=>$donnees['longitude'],'date_releve'=>$donnees['date_releve'],'photo'=>$donnees['photo'],'nom_collecteur'=>$donnees['nom_collecteur'],'prenom_collecteur'=>$donnees['prenom_collecteur'],'commentaire'=>$donnees['commentaire']);
        }
        header("Content-Type:application/json");
        echo json_encode($data);
    }

?>
