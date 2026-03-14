<?php include_once __DIR__ . '/../partials/header.php'; ?>
<section class="hero">

    <?php if (isset($_SESSION['logged'])) { ?>
        <h2>Bienvenue sur Sakila <?= $_SESSION['logged']['username'] ?></h2>
    <?php } else { ?>
        <h2>Bienvenue sur Sakila </h2>
    <?php } ?>
    <p>
        Explorez le catalogue de films, la liste des acteurs, les données financières et l'implantation de nos magasins.
    </p>
</section>
<section class="card-nav">
    <a href="<?= BASE_URL ?>source/pages/moviesList.php"  style="--couleur: #6c8eff">
        <div>
            <p>🎬</p>
            <h4>Liste des films</h4>
            <p>Catalogue complet avec titre, durée et note</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/actorList.php" style="--couleur: #a78bfa">
        <div>
            <p>🎭</p>
            <h4>Liste des acteurs</h4>
            <p>Tous nos acteurs</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/magasinPlace.php" style="--couleur: #34d399">
        <div>
            <p>🛒</p>
            <h4>Nos magasins</h4>
            <p>Adresses, managers et contacts</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/cateList.php" style="--couleur: #f59e0b">
        <div>
            <p>💰</p>
            <h4>Données financières</h4>
            <p>Chiffre d'affaires par boutique</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/financarieData.php" style="--couleur: #f87171">
        <div>
            <p>🏷️</p>
            <h4>Catégorie</h4>
            <p>16 genres, nombre de films</p>
        </div>
    </a>
</section>

<!-- mettre des mettre coocki pour les thème -->
<?php include_once __DIR__ . '/../partials/footer.php'; ?>