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
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php
include('connexion_bdd.php');
include('pied.php');



if (isset($_POST['nom']) && isset($_POST['description']) && isset($_FILES['image'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    $extensions = ['.png', '.jpg', '.jpeg'];
    $extensionImage = strrchr($image['name'], '.');

    $nomImage = $image['name'];
    $dict_car_remp = array(
        ' ' => '_',
        '/' => '_',
        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'à' => 'a',
        'â' => 'a',
        'î' => 'i',
        'ï' => 'i',
        'ô' => 'o',
        'ö' => 'o',
        'ù' => 'u',
        'û' => 'u',
        'ç' => 'c',
        'É' => 'E',
        'È' => 'E',
        'Ê' => 'E',
        'À' => 'A',
        'Â' => 'A',
        'Î' => 'I',
        'Ï' => 'I',
        'Ô' => 'O',
        'Ö' => 'O',
        'Ù' => 'U',
        'Û' => 'U',
        'Ç' => 'C',
    );
    //$nomImage = strtr($nomImage, $dict_car_remp);
    //$nomImage = strtolower($nomImage);
    $cheminImage = 'images/' . $nomImage;




    if (in_array($extensionImage, $extensions)) {
        if ($image['size'] <= 1000000) {
            move_uploaded_file($image['tmp_name'], $cheminImage);
            // on verrifie si l'image a bien été upload
            if (file_exists($cheminImage)) {
                echo '<div class="alert alert-success" role="alert"> L\'image a bien été uploadée ! <button
                 type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                header('Location: ajouter_especes.php?erreur3');
            }
        } else {
            header('Location: ajouter_especes.php?erreur');
        }


        // on enregistre l'espèce dans la bdd
        try {
            $sql = "INSERT INTO `espece`(`id_espece`, `nom_espece`, `description_espece`, `chemin_photo_espece`) VALUES (NULL, :nom, :descri, :chemin)";
            $req = $bdd->prepare($sql);

            echo '<div class="alert alert-success" role="alert"> requete : ' . $sql . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

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
