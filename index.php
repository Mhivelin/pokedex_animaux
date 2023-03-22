<?php
include('entete.php');

include('connexion_bdd.php');

//requete pour afficher les especes 5 derniers especes ajoutés par des utilisateurs
$requete = $bdd->prepare('  SELECT nom_espece, description_espece, chemin_photo_espece, nom_utilisateur, date_heure_ajout_espece
                            FROM avoir_espece 
                            JOIN espece ON avoir_espece.id_espece = espece.id_espece 
                            JOIN utilisateur ON avoir_espece.id_utilisateur = utilisateur.id_utilisateur 
                            ORDER BY avoir_espece.id_espece 
                            DESC LIMIT 5');

$requete->execute();

$resultats = $requete->fetchAll(PDO::FETCH_ASSOC);

?>

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <?php
            foreach ($resultats as $resultat) {
                echo '
                <div class="carousel-item">
                    <img src="' . $resultat['chemin_photo_espece'] . '" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>' . $resultat['nom_espece'] . '</h5>
                        <p>' . $resultat['description_espece'] . '</p>
                        <p> Ajouté par : ' . $resultat['nom_utilisateur'] . '</p>
                        <p> Le : ' . $resultat['date_heure_ajout_espece'] . '</p>
                        
                    </div>
                </div>
                ';
            }

            ?>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>






















<?php
include('pied.php');

?>