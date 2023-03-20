<?php
include('entete.php');

if (empty($_SESSION['login']) || empty($_SESSION['password'])) {
    // si inexistante ou nulle, on redirige vers le formulaire de login
    header('Location: login.php');
    exit();
} else {
    echo '<div class="alert alert-success" role="alert"> Vous êtes connecté ! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}

?>




<div class="card" style="width: 18rem;">
    <img src="images/ACTINIA_FRAGACEA.png" class="card-img-top" alt="ACTINIA_FRAGACEA">
    <div class="card-body">
        <h5 class="card-title">ACTINIA FRAGACEA</h5>
        <p class="card-text">Actinia fragacea est une espèce de cnidaires anthozoaires de la famille des Actiniidae.</p>
        <a href="#" class="btn btn-primary">afficher plus</a>
    </div>
</div>


























<?php
include('pied.php');

?>