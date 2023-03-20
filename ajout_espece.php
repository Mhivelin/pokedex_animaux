<?php

$login = 'root';
$password = '';
$database = 'zoo';
$host = 'localhost';

$link = mysqli_connect($host, $login, $password, $database);


if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['image'])) {
    //nom en majuscule
    $nom = $_POST['nom'];
    $nom = strtoupper($nom);
    $nom = trim($nom);

    $description = $_POST['description'];

    //image

    $EXTENSION = array('jpg', 'jpeg', 'png');
    $MAX_SIZE = 1000000;
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_extension = pathinfo($image, PATHINFO_EXTENSION);
    $image = $nom . '.' . $image_extension;


    $erreur = "";
}
