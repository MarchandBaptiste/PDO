<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getfinancarie.php';
$db = db();
$financariesData = getfinancarie($db);
?>
<h2>Voici les données financière</h2>
<section class="data-column">
    <article>
        <h3 class="sous-titre">Chiffre d'affaires</h3>
        <div class="data">
            <?php foreach ($financariesData as $financariesDat) : ?>
                <div class="card-finacarie">
                    <h4 class="mutedText">Chiffre d'affaire - BOUTIQUE #<?= htmlspecialchars($financariesDat['store_id']) ?></h4>
                    <p class="ca"><?= htmlspecialchars($financariesDat['ca']) ?> €</p>
                </div>
            <?php endforeach ?>
        </div>
    </article>
    <hr>
    <article>
        <h3 class="sous-titre">Films vendu</h3>
        <div class="data">
        <?php foreach ($financariesData as $financariesDat) : ?>
            <div class="card-finacarie">
                <h4 class="mutedText">Films vendu - BOUTIQUE #<?= htmlspecialchars($financariesDat['store_id']) ?></h4>
                <p class="ca"><?= htmlspecialchars($financariesDat['nbMovie']) ?></p>
            </div>
        <?php endforeach ?>
        </div>
    </article>
</section>
<?php include_once('../partials/footer.php'); ?>