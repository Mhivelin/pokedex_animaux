<?php

/* on se connecte a la base de donnees
$host = 'localhost';
$login = 'root';
$password = 'root';

try {
    $bdd = new PDO('mysql:host=' . $host . ';dbname=pokedex;charset=utf8', $login, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}





// on recupere le mot de passe de la table qui correspond au login du visiteur
$req = $bdd->prepare('select password from user where login = :login');
$req->execute(array('login' => $login));
$resultat = $req->fetch();
$erreur = "";

// on le compare a celui qu'il a entre et on verifie si le membre existe

if (!$resultat) {
    $erreur = 'Mauvais identifiant ou mot de passe !';
} else {
    if ($password == $resultat['password']) {
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        header('Location: index.php');
    } else {
        echo '<div class="alert alert-danger" role="alert"> Mauvais mot de passe !</div>';
    }
}
*/

//connection provisoire

$erreur = "";
if (isset($_POST['login']) && isset($_POST['password'])) {
    if ($_POST['login'] == 'admin' && $_POST['password'] == 'admin') {
        session_start();
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        header('Location: index.php');
    } else {
        echo '<div class="alert alert-danger" role="alert"> Mauvais mot de passe !</div>';
        $erreur = 'Mauvais identifiant ou mot de passe !';
    }
}



?>


<DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Connexion</h1>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control" id="login" name="login">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
    </body>

    </html>