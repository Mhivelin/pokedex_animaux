<?php
include('entete.php');
// on regarde si le header contient success
if (isset($_GET['success'])) {
    echo '<div class="alert alert-success" role="alert"> L\'espèce a bien été ajoutée ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
if (isset($_GET['erreur'])) {
    echo '<div class="alert alert-danger" role="alert"> Le fichier est trop volumineux ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
if (isset($_GET['erreur2'])) {
    echo '<div class="alert alert-danger" role="alert"> Le fichier n\'est pas une image ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

?>

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

            <?php
            if (isset($_GET['erreur'])) {
                echo '<div class="alert alert-danger" role="alert"> Le fichier est trop volumineux !</div>';
            }
            if (isset($_GET['erreur2'])) {
                echo '<div class="alert alert-danger" role="alert"> Le fichier n\'est pas une image !</div>';
            }
            ?>

        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
$host = 'localhost';
$login = 'pokedex';
$password = 'password';

try {
    $bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
} catch (PDOException $e) {
    echo
    '<div class="alert alert-success" role="alert"> pas de connection a la bdd <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

if (isset($_POST['nom']) && isset($_POST['description']) && isset($_FILES['image'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $nomImage = $image['name'];
    $cheminImage = 'images/' . $nomImage;


    $extensions = ['.png', '.jpg', '.jpeg'];
    $extensionImage = strrchr($nomImage, '.');


    if (in_array($extensionImage, $extensions)) {
        if ($image['size'] <= 1000000) {
            move_uploaded_file($image['tmp_name'], $cheminImage);
        } else {
            header('Location: ajouter_especes.php?erreur');
        }


        // on enregistre l'espèce dans la bdd
        try {
            $sql = "INSERT INTO `espece`(`id_espece`, `nom_espece`, `description_espece`, `chemin_photo_espece`) VALUES (NULL, :nom, :descri, :chemin)";
            $req = $bdd->prepare($sql);

            $req->bindParam(':nom', $nom);
            $req->bindParam(':descri', $description);
            $req->bindParam(':chemin', $cheminImage);

            $req->execute();
        } catch (PDOException $e) {
            echo
            '<div class="alert alert-success" role="alert"> erreur d\'enregistrement dans la bdd <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }





        header('Location: ajouter_especes.php?success');
    } else {
        header('Location: ajouter_especes.php?erreur2');
    }
}