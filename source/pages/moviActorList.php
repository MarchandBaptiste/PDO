<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMoviesActors.php';
$actorId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$db = db();
$movies = getMoviesActors($db, $actorId);
?>
<h2>Filmographie de l'acteur</h2>
<section class="filmographie">
    <?php if (empty($movies)) { ?>
        <p>Acteur introuvable.</p>
    <?php } else { ?>
        <div class="sous-titre">
            <h3><?= htmlspecialchars($movies[0]['first_name'] . ' ' . $movies[0]['last_name']) ?></h3>
            <p class="mutedText">ID acteur : #<?= htmlspecialchars($movies[0]['actor_id']) ?></p>
        </div>
    <?php } ?>
    <div class="card-conteneur">
        <?php foreach ($movies as $movie) : ?>
            <div class="card">
                <h4><?php echo htmlspecialchars($movie['title']) ?></h4>
                <p class="mutedText"><?= htmlspecialchars($movie['description']) ?></p>
                <div><span>📆 </span> <?= htmlspecialchars($movie['release_year']) ?>
                    <span>🕐 </span> <?= htmlspecialchars($movie['length']) ?>
                    <span>📈 </span> <?= htmlspecialchars($movie['rating']) ?>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</section>
<?php include_once('../partials/footer.php');
?>