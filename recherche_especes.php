<?php
include('entete.php');
?>

<h1 class="text-center">Recherche d'espèces</h1>

<div class="container">

  <?php

  $host = 'localhost';
  $login = 'pokedex';
  $password = 'password';

  try {
    $bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
    echo '<div class="alert alert-success" role="alert"> Connexion à la base de données réussie !</div>';
  } catch (Exception $e) {
    echo '<div class="alert alert-danger" role="alert"> Erreur de connexion à la base de données !</div>';
  }


  $sql = "SELECT nom_espece, description_espece, chemin_photo_espece FROM espece";
  $req = $bdd->prepare($sql);
  $req->execute();
  $resultats = $req->fetchAll();


  ?>


  <div class="container-fluid">
    <div class="row">

      <?php
      foreach ($resultats as $resultat) {
        $image = file_get_contents($resultat['chemin_photo_espece']);

        echo '
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card mb-4">
            <img src="data:image/png;base64,' . base64_encode($image) . '" class="card-img-top" alt="' . $resultat['nom_espece'] . '">
          <div class="card-body">
            <h2 class="card-title">' . $resultat['nom_espece'] . '</h2>
            <p class="card-text">' . $resultat['description_espece'] . '</p>
            <a href="#" class="btn btn-primary">Afficher plus</a>
          </div>
        </div>
      </div>
      ';
      }
      ?>

    </div>
  </div>


</div>

<?php
include('pied.php');
?>