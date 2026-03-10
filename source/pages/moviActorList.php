<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMoviesActors.php';
$actorId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$db = db();
$movies = getMoviesActors($db, $actorId);
?>
<h2>Liste des films réaliser par l'acteur qui a l'id : <?= $actorId ?></h2>
<section>
    <?php foreach ($movies as $movie) : ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($movie['title']) ?></h3>
            <p>Description : <?= htmlspecialchars($movie['description']) ?></p>
            <p>Date de sortie : <span><?= htmlspecialchars($movie['release_year']) ?></span></p>
            <p>Durée : <?= htmlspecialchars($movie['length']) ?></p>
            <p>Note : <?= htmlspecialchars($movie['rating']) ?></p>
        </div>
    <?php endforeach ?>
</section>
<?php include_once('../partials/footer.php');
?>