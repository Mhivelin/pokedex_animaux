<?php
include('entete.php');
?>

<div class="container">
    <h1 class="text-center">Ajouter une espèce</h1>
    <form action="ajout_espece.php" method="post" enctype="multipart/form-data">
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
include('pied.php');
?>