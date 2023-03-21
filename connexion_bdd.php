<?php
$host = 'localhost';
$login = 'pokedex';
$password = 'password';

try {
$bdd = new PDO("mysql:host=$host;dbname=pokedex", $login, $password);
} catch (Exception $e) {
echo '<div class="alert alert-danger" role="alert"> Erreur de connexion à la base de données !</div>';
}