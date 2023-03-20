<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex annimaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="navbar navbar-expand-lg">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recherche_especes.php">Recherche</a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="moncompte.php">Mon compte</a>
            </li>






            <!-- bouton deconnexion aligné à droite -->
            <li class="nav-item ms-auto">
                <button type="button" class="primary btn btn-primary" onclick="window.location.href='deconnexion.php'">Déconnexion</button>
            </li>

        </ul>
    </div>

    <?php
    // entete de toutes les pages

    // on demarre la session
    session_start();

    // on teste si la erreur vaut autre chose que ""
    if ($erreur != "") {
        // si inexistante ou nulle, on redirige vers le formulaire de login
        header('Location: login.php');
        exit();
    }

    ?>