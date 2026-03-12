<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getCate.php';
$db = db();
$categories = getCate($db);
?>
<h2>Voici la liste des catégories de films disponible</h2>
<section>
    <?php foreach ($categories as $categorie) : ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($categorie['name']) ?></h3>
            <p><span>Nombre de film de cette catégorie : </span><?= htmlspecialchars($categorie['Nombre de film par catégory']) ?></p>
        </div>
    <?php endforeach ?>
</section>

<?php include_once('../partials/footer.php');
