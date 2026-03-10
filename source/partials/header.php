<?php include_once __DIR__ . '/../database/database.php';
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}
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
  <meta name="description" content="Description du site" />
</head>

<body>
  <!-- En-tête du site -->
  <header>
    <h1>Ceci est un TD qui parle de films et d'acteurs</h1>
    <nav>
      <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="/source/pages/moviesList.php">Liste des films</a></li>
        <li><a href="/source/pages/actorList.php">Liste des acteurs</a></li>
        <li><a href="/source/pages/magasinPlace.php">L'implantation des magasins</a></li>
        <li><a href="/source/pages/cateList.php">Liste de catégorie </a></li>
        <li><a href="/source/pages/financarieData.php">Consultation des données financières </a></li>
      </ul>
    </nav>
  </header>