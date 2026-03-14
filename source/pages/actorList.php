<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getActors.php';
$db = db();
$nb_item = [25, 50, 100, 200, 500, 1000];
$actors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nbActor = filter_input(INPUT_POST, 'nbActor', FILTER_SANITIZE_NUMBER_INT);
    if (!in_array($nbActor, $nb_item)) {
        $nbActor = 25;
    }
    $actors = getActors($db, $nbActor);
}
?>
<h2>Liste des acteurs</h2>
<form action="" method="POST">
    <div>
        <label for="nbActor">Nombre d'acteur que vous souhaitez voir</label>
        <select name="nbActor" id="nbActor">
            <option value="">--Veuillez choisir une option--</option>
            <?php foreach ($nb_item as $item) : ?>
                <option value="<?= $item ?>"><?= $item ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit">Envoyer</button>
</form>

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
</section>

<?php include_once('../partials/footer.php'); ?>