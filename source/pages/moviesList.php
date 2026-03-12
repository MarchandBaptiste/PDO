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
<h2>Liste des films</h2>
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
            <p><span>Description : </span><?= htmlspecialchars($movie['description']) ?></p>
            <p><span>Date de sortie : </span><?= htmlspecialchars($movie['release_year']) ?> <i class="ri-calendar-2-line"></i></p>
            <p><span>Durée : </span><?= htmlspecialchars($movie['length']) ?> <i class="ri-time-line"></i></p>
            <p><span>Note : </span><?= htmlspecialchars($movie['rating']) ?> <i class="ri-star-line"></i></p>
        </div>
    <?php endforeach ?>
</section>

<?php include_once('../partials/footer.php'); ?>