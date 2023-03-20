    <?php

    $host = 'localhost';
    $login = 'pokedex';
    $password = 'password';

    // on se connecte à MySQL
    try {
        $bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
        echo '<div class="alert alert-success" role="alert"> Connexion à la base de données réussie !</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert"> Erreur de connexion à la base de données !</div>';
    }

    // on teste si le visiteur a soumis le formulaire de connexion
    if (isset($_POST['login']) && isset($_POST['password'])) {
        // on teste si une entrée de la base contient ce couple login / pass
        $sql = 'SELECT count(*) FROM utilisateur WHERE nom_utilisateur="' . $_POST['login'] . '" AND mot_de_passe_utilisateur="' . $_POST['password'] . '"';
        $req = $bdd->prepare($sql);
        $req->execute();
        $resultat = $req->fetch();

        if ($resultat[0] == 0) {
            echo '<div class="alert alert-danger" role="alert"> Mauvais login / password. Merci de recommencer !</div>';
        } else {
            session_start();
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: index.php');
            exit();
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
            </div>
        </body>

        </html>