<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getfinancarie.php';
$db = db();
$financariesData = getfinancarie($db);
?>
<h2>Voici les données financière : </h2>
<section>
    <?php foreach ($financariesData as $financariesDat) : ?>
        <div class="card">
            <p>Chiffre d'affaire : <?= htmlspecialchars($financariesDat['ca']) ?></p>
            <p>Boutique : <span><?= htmlspecialchars($financariesDat['store_id']) ?></span></p>
            <p>Film vendu : <?= htmlspecialchars($financariesDat['nbMovie']) ?></p>
        </div>
    <?php endforeach ?>
</section>
<?php include_once('../partials/footer.php'); ?>