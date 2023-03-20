<?php
include('entete.php');
?>

<h1 class="text-center">Recherche d'espèces</h1>

<div class="container">

    <?php
    /*
    $password = "admin";
    $login = "admin";
    $host = "localhost";
    $bdd = "pokedex";
    $table = "especes";

    try {
        $bdd = new PDO('mysql:host=' . $host . ';dbname=' . $bdd . ';charset=utf8', $login, $password);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $sql = "SELECT nom, description, chemin_image FROM especes";
    $req = $bdd->prepare($sql);
    $req->execute();
    $resultats = $req->fetchAll();
*/
    // Affichage des résultats

    $resultats = array(
        array(
            'nom' => 'Pikachu',
            'description' => 'Pikachu est une espèce de Pokémon de type Électrik de la franchise Pokémon.',
            'chemin_image' => 'https://cdn.bulbagarden.net/upload/b/b2/Spr_5b_025_m.png'
        ),
        array(
            'nom' => 'Bulbizarre',
            'description' => 'Bulbizarre est une espèce de Pokémon de type Plante et Poison de la franchise Pokémon.',
            'chemin_image' => 'https://cdn.bulbagarden.net/upload/2/21/Spr_5b_001.png'
        ),
        array(
            'nom' => 'ACTINIA FRAGACEA',
            'description' => 'ACTINIA FRAGACEA est une espèce de Pokémon de type Plante et Poison de la franchise Pokémon.',
            'chemin_image' => 'images/ACTINIA_FRAGACEA.png'
        )
    );
    ?>


    <div class="container-fluid">
        <div class="row">

            <?php
            foreach ($resultats as $resultat) {
                echo '
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card mb-4">
          <img src="' . $resultat['chemin_image'] . '" class="card-img-top" alt="' . $resultat['nom'] . '">
          <div class="card-body">
            <h2 class="card-title">' . $resultat['nom'] . '</h2>
            <p class="card-text">' . $resultat['description'] . '</p>
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