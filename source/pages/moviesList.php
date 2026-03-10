<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMovies.php';
$db = db();
$nb_item = [25, 50, 100, 200, 500, 1000];
$movies = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nbMovie = filter_input(INPUT_POST, 'nbMovie', FILTER_SANITIZE_NUMBER_INT);
    if (!in_array($nbMovie, $nb_item)) {
        $nbMovie = 25;
    }
    $movies = getMovies($db, $nbMovie);
}
?>
<h2>Liste des films :</h2>
<form action="" method="POST">
    <div>
        <label for="nbMovie">Nombre de films que vous souhaitez voir :</label>
        <select name="nbMovie" id="nbMovie">
            <option value="">--Veuillez choisir une option--</option>
            <?php foreach ($nb_item as $item) : ?>
                <option value="<?= $item ?>"><?= $item ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Envoyer</button>
</form>
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

<?php include_once('../partials/footer.php'); ?>

