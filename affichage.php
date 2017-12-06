<?php
    include 'html/entete.php'; /* On recupere l entete de la page html */
    include 'bdd/bdd.php'; /* On recupere les methodes d'acces et de manipulation de la bdd */
    $bd=connexionbd();
    $requete='SELECT * from releves';  /*On prepare une requete permettant de recupere l'ensemble de la table releves */
    $value=requete($bd,$requete); /* value recupere la reponse de la requete */
    echo "<div>";
    echo "<br/><h2>Liste non dynamique des plantes de la base de donnees !</h2><br/>";
    echo "<table>
                <tr>
                    <th> ID </th>
                    <th> Nom plante </th>
                    <th> Lieu </th>
                    <th> Latitude </th>
                    <th> Longitude </th>
                    <th> Date de releve </th>
                    <th class='enlevable'> Photo </th>
                    <th> Nom collecteur </th>
                    <th> Prenom collecteur </th>
                    <th> Commentaire </th>
                </tr>";
    foreach ($value as $valeur) { /* On parcourt le tableau de tableau */
        echo "<tr>";
        foreach ($valeur as $cle => $resultat) { /* On recupere la cle et la valeur de chaque element */
            if ($cle=="photo") {
                echo "<td class='enlevable'> <img src=$resultat class='imagePlante' /> </td>";
            }else {
                echo "<td>$resultat</td> ";
            }
        }
        echo "</tr>";
    }
    echo "</table></div><br/>";

    include 'html/pied.html'; /*On ferme la page html avec le footer */
?>
