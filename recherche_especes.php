<?php
include('entete.php');

$host = 'localhost';
$login = 'pokedex';
$password = 'password';

try {
  $bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
} catch (Exception $e) {
  echo '<div class="alert alert-danger" role="alert"> Erreur de connexion à la base de données !</div>';
}

// SELECT nom_espece, description_espece, chemin_photo_espece FROM espece WHERE nom_espece LIKE '%pikachu%';

if (isset($_GET['recherche'])) {
  $recherche = $_GET['recherche'];
  $sql = "SELECT nom_espece, description_espece, chemin_photo_espece FROM espece WHERE nom_espece LIKE '%$recherche%'";
  $resultats = $bdd->query($sql);
} else {
  $sql = "SELECT nom_espece, description_espece, chemin_photo_espece FROM espece";
  $resultats = $bdd->query($sql);
}

echo '<div class= alert alert-success role=alert> requete : ' . $sql . '</div>';
















?>

<h1 class="text-center">Recherche d'espèces</h1>

<div class="container">

  <div class="row">
    <div class="col-lg-12">
      <form action="recherche_especes.php" method="GET">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Rechercher une espèce" name="recherche">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
          </div>
        </div>
      </form>
    </div>






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