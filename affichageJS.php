<?php
    include 'html/entete.php';
?>
<br/><h2>Liste dynamique des plantes de la base de donnees !</h2><br/>
<form method='POST' id="afficher">
    <label>Recherche : </label><input type='text' id='recherche' name='recherche'/>
    <button type="submit">Afficher les données</button>
</form>
<br/>
<div id="messageRecherche">

</div>
<div id="listing">

</div>
<br/>
<div class='formulaire'>
    Formulaire d'ajout d'une donnee : <br/><br/>
    <form method='POST' id="ajout">
        <fieldset>
            <legend>
                Information de la plante
            </legend>
            <p>
                <label>Nom de la plante : </label><input type='text' name='nom_plante' required /><br/>
                <label>Lieu de récolte : </label><input type='text' name='lieu' required/><br/>
                <label>Latitude : </label><input type='text' name='latitude' /> <br/>
                <label>Longitude : </label><input type='text' name='longitude'/><br/>
                <label>Date : </label><input type='date' name='date_releve' required  /><br/>
                <label>Photo : </label><input type='url' name='photo' value=''/><br/>
            </p>
        </fieldset>
        <fieldset>
            <legend>
                Information collecteur
            </legend>
            <p>
                <label>Nom : </label><input type='text' name='nom_collecteur' value=''/><br/>
                <label>Prenom : </label><input type='text' name='prenom_collecteur' value=''/><br/>
                <label>Commentaire : </label><input type='textarea' name='commentaire' value=''/><br/>
            </p>
        </fieldset>
        <input type='submit' value="Valider" />
    </form>
</div>

<?php
    include 'html/pied.html';
?>
