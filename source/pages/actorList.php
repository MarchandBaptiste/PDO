<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getActors.php';
$db = db();

$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
$page = ($page && $page > 0) ? $page : 1;
$offset = ($page - 1) * 15;

$total = countActors($db);
$totalPages = ceil($total / 15);

$actors = getActors($db, $offset);
?>
<h2>Liste des acteurs</h2>
<section>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Filmographie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actors as $actor) : ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($actor['last_name']) ?></th>
                    <td><?= htmlspecialchars($actor['first_name']) ?></td>
                    <td><a href="<?= BASE_URL ?>source/pages/moviActorList.php?id=<?= $actor['actor_id'] ?>" class="btn">Voir plus de films</a></td>
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