<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMovies.php';
$db = db();
$movies = [];

$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$page = ($page && $page > 0) ? $page : 1;
$offset = ($page - 1) * 15;

$total = countMovies($db);
$totalPages = ceil($total / 15);

$movies = getMovies($db, $offset);
?>
<h2>Liste des films</h2>
<section>
    <table>
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Date de sortie</th>
                <th>Durée</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie) : ?>
                <tr>
                    <th scope="row"><?php echo htmlspecialchars($movie['title']) ?></th>
                    <td class="describ"><?= htmlspecialchars($movie['description']) ?></td>
                    <td><?= htmlspecialchars($movie['release_year']) ?></td>
                    <td><?= htmlspecialchars($movie['length']) ?> min</td>
                    <td><span class="rat"><?= htmlspecialchars($movie['rating']) ?></span></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>>
                <?= $i ?>
            </a>
        <?php endfor ?>
    </nav>
</section>

<?php include_once('../partials/footer.php'); ?>