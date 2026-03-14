<?php
// on met require car si on peut pa se connecter a la base de donnée on fait plus de php car sinon on va avoir plein d'erreur
if (!defined('BASE_URL')) {
  define('BASE_URL', '/');
}
require_once __DIR__ . '/../database/database.php';
session_start();
// pour la déconexion
if (isset($_SESSION['logged']) && isset($_GET['logout'])) {
  session_destroy();
  header('Location: /source/pages/home.php');
  exit();
}
// if (isset($_POST['reset'])) {

//         setcookie("theme", '', time() -1, "/");
//     } else {
//         setcookie("theme", htmlspecialchars($_POST['color']), time() + (24 * 3600), "/");
//     }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Définition du jeu de caractères -->
  <meta charset="UTF-8" />
  <!-- Adaptation à la taille de l’écran -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Titre affiché dans l’onglet du navigateur -->
  <title>Salika</title>
  <!-- Lien vers la feuille de style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
  <!-- pour les icon -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
  <meta name="description" content="Description du site" />
</head>

<body class="<?= $_COOKIE['theme'] ?? $_POST['color'] ?? 'light' ?>">
  <!-- En-tête du site -->
  <header>
    <nav>
      <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/moviesList.php">Films</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/actorList.php">Acteurs</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/magasinPlace.php">Magasins</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/cateList.php">Catégorie</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/financarieData.php">Données financières</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/connexion.php?logout" class="<?= isset($_SESSION['logged']) ? 'active' : '' ?>""><?= isset($_SESSION['logged']) ? 'Deconexion' : 'Connexion' ?></a></li>
      </ul>
    </nav>
    <form action="" method=" post">
            <label class="switch">
              <input type="checkbox" name="color">
              <span class="slider round"></span>
              </form>
            </label>
  </header>
  <main>