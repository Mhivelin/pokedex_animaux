<?php
include('connexion_bdd.php');

include('entete.php');



if (isset($_POST['nom_espece'])) {
    $nom_espece = $_POST['nom_espece'];
    $requete = $bdd->prepare("SELECT id_espece FROM espece WHERE nom_espece = '$nom_espece'");
    $requete->execute();
    $id_espece = $requete->fetch();
    $id_espece = $id_espece['id_espece'];

    $utilsateur = $_SESSION['login'];
    $requete_util = $bdd->prepare("SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur = '$utilsateur'");
    $requete_util->execute();
    $id_utilisateur = $requete_util->fetch();
    $id_utilisateur = $id_utilisateur['id_utilisateur'];


    $date_heure_ajout_espece = date("Y-m-d H:i:s");

    $sql = "INSERT INTO `avoir_espece`(`id_utilisateur`, `id_espece`, `date_heure_ajout_espece`) VALUES ('$id_utilisateur','$id_espece','$date_heure_ajout_espece')";
    $requete = $bdd->prepare($sql);
    $requete->execute();
    echo '<div class="alert alert-success" role="alert"> requete : ' . $sql . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>

<div class="container">
    <form method="POST" action="nouvelle_espece.php">

        <label for="nom" class="form-label">Nom de l'espèce à Ajouter</label>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="espece_existante" name="espece_existante" onclick="afficher()" checked>
            <label class="form-check-label" for="espece_existante">l'espèce existe déjà</label>
        </div>

        <div id="ajouter_espece" style="display: none;">
            <div class="container">
                <h1 class="text-center">Ajouter une espèce</h1>
                <form action="ajouter_especes.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">valider_espece</button>
                </form>
            </div>
        </div>




        <div id="selctionner_espece">
            <form method="POST" action="nouvelle_espece.php">
                <div class="mb-3">

                    <label for="nom" class="form-label">Nom de l'espèce à Ajouter</label>
                    <select class="form-select" aria-label="Default select example" name="nom_espece">
                        <option selected>choisir une espèce</option>

                        <?php
                        $utilsateur = $_SESSION['login'];
                        $requete_util = $bdd->prepare("SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur = '$utilsateur'");
                        $requete_util->execute();
                        $id_utilisateur = $requete_util->fetch();
                        $id_utilisateur = $id_utilisateur['id_utilisateur'];

                        $requete = $bdd->prepare("SELECT nom_espece FROM espece WHERE id_espece NOT IN (SELECT id_espece FROM avoir_espece WHERE id_utilisateur = '$id_utilisateur')");
                        $requete->execute();
                        $resultat = $requete->fetchAll();
                        foreach ($resultat as $espece) {
                            echo '<option value="' . $espece['nom_espece'] . '">' . $espece['nom_espece'] . '</option>';
                        }

                        ?>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Ajouter</button>

            </form>

        </div>

        <script>
            function afficher() {
                if (document.getElementById('espece_existante').checked) {
                    document.getElementById('ajouter_espece').style.display = 'none';
                    document.getElementById('selctionner_espece').style.display = 'block';
                } else {
                    document.getElementById('ajouter_espece').style.display = 'block';
                    document.getElementById('selctionner_espece').style.display = 'none';
                }
            }
            afficher();
        </script>

        <?php


        include('pied.php');
        ?>