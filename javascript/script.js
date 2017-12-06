document.addEventListener('DOMContentLoaded', function() {


    function supprimer_donnees(formulaire) {
        var request = new XMLHttpRequest();
        request.addEventListener('load', function(data) { // quand la requete est effectue
            window.alert(data.target.responseText); // on affiche la reponse du webservice dans une pop-up
            liste(); //et on affiche la liste actualise
        });
        request.open("POST", "php/delete_donnees.php");
        request.send(new FormData(formulaire));
    }

// Affiche la liste des tuples de la bdd
    function liste() {

        var request = new XMLHttpRequest(); // on prepare AJAX

        request.addEventListener('load', function(data) { // Quand la requete sera envoye on affichera

            var ret = JSON.parse(data.target.responseText); // le resultat de la requete sous forme de tableau
            var new_html = '';
            if (ret.releves.length == 0) {
                new_html += 'Pas de données disponibles';
                document.querySelector('#listing').innerHTML = new_html; //reference la div dont id=listing sur affichageJS
            } else {
                new_html += '<div></br>';
                new_html += '<table>';
                new_html += '<tr>';
                new_html += '<th> ID </th>';
                new_html += '<th> Nom plante </th>';
                new_html += '<th> Lieu </th>';
                new_html += '<th> Latitude </th>';
                new_html += '<th> Longitude </th>';
                new_html += '<th> Date de releve </th>';
                new_html += '<th class=\'enlevable\'> Photo </th>';
                new_html += '<th> Nom collecteur </th>';
                new_html += '<th> Prenom collecteur </th>';
                new_html += '<th> Commentaire </th>';
                new_html += '<th> Suppression</th>';
                new_html += '</tr>';
                for (var i = 0; i < ret.releves.length; i++) {
                    new_html += '<tr>';
                    new_html += '<td>' + ret.releves[i].id + '</td>';
                    new_html += '<td>' + ret.releves[i].nom_plante + '</td>';
                    new_html += '<td>' + ret.releves[i].lieu + '</td>';
                    new_html += '<td>' + ret.releves[i].latitude + '</td>';
                    new_html += '<td>' + ret.releves[i].longitude + '</td>';
                    new_html += '<td>' + ret.releves[i].date_releve + '</td>';
                    if (ret.releves[i].photo == '') {
                        new_html += '<td class=\'enlevable\'>pas d\'image</td>';
                    } else {
                        new_html += '<td class=\'enlevable\'><img class="imagePlante" src="' + ret.releves[i].photo + '"/></td>';
                    }
                    new_html += '<td>' + ret.releves[i].nom_collecteur + '</td>';
                    new_html += '<td>' + ret.releves[i].prenom_collecteur + '</td>';
                    new_html += '<td>' + ret.releves[i].commentaire + '</td>';
                    new_html += '<td><form method="POST" class="suppression">';
                    new_html += '<input type="hidden" name="id_do" value="' + ret.releves[i].id + '"/>';
                    new_html += '<button type="submit">Supprimer</button>';
                    new_html += '</form></td>';
                    new_html += '</tr>';
                }
                new_html += '</table></div></br>';
                document.querySelector('#listing').innerHTML = new_html;

                var supprimer = document.getElementsByClassName('suppression'); // on ajoute aux boutons supprimer leurs fonctions
                for (var i = 0; i < supprimer.length; i++) {
                    supprimer[i].addEventListener("submit", function(event) {
                        event.preventDefault();
                        supprimer_donnees(this);
                    });
                }
            }

            var textarea = document.getElementById('recherche');
            textarea.value = ''; // on reinitialise la barre de recherche

        });
        request.open("POST", "php/liste.php"); // on envoie la requete
        request.send(new FormData(form));


    }


    function bouton_connexion(){
        var authentification = document.getElementById('connexion')
        authentification.addEventListener("submit", function(event) {
            event.preventDefault();
            var request = new XMLHttpRequest();
            request.addEventListener('load', function(data) {
                login = data.target.responseText; // on recupere le resultat du webservice
                new_html = "";
                if (login=="") { // si le webservice n'a rien envoye on redemande le login et le mot de passe
                    new_html += "Mauvais mom d'utilisateur ou mot de passe";
                    new_html += "<form method='POST' id='connexion'>";
                    new_html +=    "<input type='text' placeholder='Login'name='login' id='login' /></br>";
                    new_html +=    "<input type='password' placeholder='Mot de passe' name='mdp' id='mdp' /></br>";
                    new_html +=    "<input type='submit' value='Se connecter' />";
                    new_html += "</form>";
                    document.querySelector('#authentification').innerHTML = new_html;
                    bouton_connexion(); // et on relance la fonction

                } else { // sinon on affiche le nom de l'utilisateur et un bouton de deconnexion
                    new_html += "Bienvenue "+login;
                    new_html += "<form method='POST' id='deconnexion'>";
                    new_html +=     "<input type='submit' value='Se déconnecter' />";
                    new_html += "</form>";
                    document.querySelector('#authentification').innerHTML = new_html;

                    bouton_deconnexion();

                }
            });
            request.open("POST", "php/authentification.php");
            request.send(new FormData(authentification));
        });
    }

    function bouton_deconnexion(){
        var deconnexion = document.getElementById('deconnexion');
        deconnexion.addEventListener("submit", function(event) { // Quand on clique sur le bouton on affiche de nouveau la div de connexion
            event.preventDefault();
            var request = new XMLHttpRequest();
            request.addEventListener('load', function(data) {
                new_html = "Identification : ";
                new_html += "<form method='POST' id='connexion'>";
                new_html +=    "<input type='text' placeholder='Login' name='login' id='login' /></br>";
                new_html +=    "<input type='password'placeholder='Mot de passe' name='mdp' id='mdp' /></br>";
                new_html +=    "<input type='submit' value='Se connecter' />";
                new_html += "</form>";
                document.querySelector('#authentification').innerHTML = new_html;
                bouton_connexion();
            });
            request.open("POST", "php/deconnexion.php");
            request.send();
        });
    }// fin bouton_deconnexion

    if (document.getElementById('afficher')){ // si un bouton afficher se trouve sur la page on y "accroche" la fonciton corresponsante
        var form = document.getElementById('afficher');
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            liste();
        });
    }

    if (document.getElementById('ajout')){
        var ajouter = document.getElementById('ajout')
        ajouter.addEventListener("submit", function(event) {
            event.preventDefault();
            var request = new XMLHttpRequest();
            request.addEventListener('load', function(data) {
                liste();
            });
            request.open("POST", "php/add_donnees.php");
            request.send(new FormData(ajouter));
        });
    }

    if (document.getElementById('connexion')){
        bouton_connexion();
    }

    if (document.getElementById('deconnexion')){
        bouton_deconnexion();
    }


})
