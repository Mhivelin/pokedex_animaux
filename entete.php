<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<?php
// entete de toutes les pages

// on demarre la session
session_start();

// on teste si la variable de session existe et contient une valeur
if (empty($_SESSION['login']) || empty($_SESSION['password'])) {
    // si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: login.php');
    exit();
}

?>



<body>


    <div class="navbar navbar-expand-lg flex-column flex-md-row bd-navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recherche_especes.php">Rechercher une espèce</a>
            </li>

            <?php //aligné à droite 
            ?>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    mon compte
                </button>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="compte.php">Mon compte</a>
                    </li>
                    <?php
                    //afficher le nom de l'utilisateur et son nombre d'espèces
                    include('connexion_bdd.php');
                    $sql = "SELECT COUNT(*) FROM espece JOIN avoir_espece ON espece.id_espece = avoir_espece.id_espece JOIN utilisateur ON avoir_espece.id_utilisateur = utilisateur.id_utilisateur WHERE utilisateur.nom_utilisateur = '" . $_SESSION['login'] . "'";
                    $resultats = $bdd->query($sql);
                    $resultat = $resultats->fetch();

                    echo '<li class="nav-item">
                <a class="nav-link" href="compte.php"> Mes espèces
            
                <span class="badge bg-secondary">' . $resultat['COUNT(*)'] . '</span>
                </a>
            </li>';

                    if ($_SESSION['login'] == 'admin') {
                        echo '<li class="nav-item">
                <a class="nav-link" href="ajouter_especes.php">Ajouter une espèce</a>
            </li>';
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </ul>
    </div>




    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>
</body>

</html>