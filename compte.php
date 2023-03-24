<?php
include('entete.php');
include('connexion_bdd.php');
?>

<div class="container">


  <h1 class="text-center">Mes espèces</h1>

  <?php
  $utilisateur = $_SESSION['id_utilisateur'];
  $id_utilisateur = "SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur = '$utilisateur'";
  $resultat = $bdd->query($id_utilisateur);
  $id_utilisateur = $resultat->fetch();
  $id_utilisateur = $id_utilisateur['id_utilisateur'];

  // select des espèces de l'utilisateur
  $sql = "SELECT nom_espece, description_espece, chemin_photo_espece FROM espece JOIN avoir_espece ON espece.id_espece = avoir_espece.id_espece JOIN utilisateur ON avoir_espece.id_utilisateur = utilisateur.id_utilisateur WHERE utilisateur.id_utilisateur = $id_utilisateur";
  $resultats = $bdd->query($sql);
  $especes = $resultats->fetchAll();

  echo '<div class alert alert-success role="alert"> Vous avez ' . count($especes) . ' espèces dans votre collection </div>';

  ?>

  <div class="container-fluid">
    <div class="row">

      <?php
      foreach ($especes as $espece) {
        echo '<div class="col-4">';
        echo '<div class="card" style="width: 18rem;">';
        echo '<img src="' . $espece['chemin_photo_espece'] . '" class="card-img-top" alt="...">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $espece['nom_espece'] . '</h5>';
        echo '<p class="card-text">' . $espece['description_espece'] . '</p>';
        echo '<a href="#" class="btn btn-primary">Go somewhere</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }

      ?>

    </div>
  </div>


  <div class="button btn btn-primary">
    <a class="text-white" href="nouvelle_espece.php">Ajouter une espèce</a>

  </div>

</div>

<?php
include('pied.php');

?>