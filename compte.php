<?php
include('entete.php');
include('connexion_bdd.php');
?>

<div class="container">
    <div class="button btn btn-primary">
        <a class="text-white" href="nouvelle_espece.php">Ajouter une espèce</a>

    </div>

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
    echo '<div class="alert alert-success" role="alert">requete : ' . $sql . '</div>';


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