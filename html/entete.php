<?php
session_start()
?>

<!DOCTYPE html>

<html>

    <head>

        <title>Bota42</title>
        <meta charset="utf-8"/>
        <!-- <link rel="stylesheet" href="./css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="css/style.css">
        <script src="javascript/script.js"></script>

    </head>

    <body>

        <header>

            <h1>Bota42</h1>
            <img id="image1Menu" src="images/logo.png" width="70px" height="100px"/>
            <img id="image2Menu" src="images/logo.png" width="70px" height="100px"/>

            <nav>

                <ul id="menuSelect">
                    <li><a href=".">Accueil</a></li>
                    <li><a href="affichage.php">Liste non dynamique</a></li>
                    <li><a href="affichageJS.php">Liste dynamique</a></li>
                </ul>

            </nav>


            <div id="authentification">
                <?php
                    if (isset($_SESSION["login"])) {
                        echo "Bienvenue ".$_SESSION["login"];;
                        echo "<form method='POST' id='deconnexion'>
                            <input type='submit' class='Connexion' value='Se déconnecter' />
                            </form>";
                    } else {
                        echo 'Identification : </br><form method="POST" id="connexion">
                            <input type="text" placeholder="Login" name="login" id="login" /></br>
                            <input type="password" placeholder="Mot de passe" name="mdp" id="mdp" /></br>
                            <input type="submit"  class="Connexion" value="Se connecter" />
                        </form>';
                    }
                ?>
            </div>



        </header>
