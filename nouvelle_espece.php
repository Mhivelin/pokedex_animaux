<?php
include('entete.php');



//on se connecte à la base de données
$host = 'localhost';
$login = 'pokedex';
$password = 'password';



try {
    $bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
} catch (PDOException $e) {
    echo
    '<div class="alert alert-danger" role="alert"> pas de connection a la bdd <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

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
            <input class="form-check-input" type="checkbox" role="switch" id="espece_existante" checked onchange="<?php 
                if (isset($_POST['espece_existante'])) {
                    include('ajouter_espece.php');
                 ?>">
            <label class="form-check-label" for="espece_existante">l'espèce existe déjà</label>
        </div>






        <select class="form-select" aria-label="Default select example" name="nom_espece">
            <option selected>choisir une espèce</option>

            <?php
            $requete = $bdd->prepare("SELECT nom_espece FROM espece");
            $requete->execute();
            $resultat = $requete->fetchAll();
            foreach ($resultat as $espece) {
                echo '<option value="' . $espece['nom_espece'] . '">' . $espece['nom_espece'] . '</option>';
            }

            ?>




        </select>

        <button type="submit" class="btn btn-primary">Ajouter</button>



    </form>

</div>

<?php
include('pied.php');
?>