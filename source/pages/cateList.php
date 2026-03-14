<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getCate.php';
$db = db();
$categories = getCate($db);
?>
<h2>Catégories</h2>
<section class="cate-column">
    <h3 class="sous-titre">Nombre de films par catégorie</h3>
    <article class="cate-data">
        <?php foreach ($categories as $categorie) : ?>
            <div>
                <h4><?php echo htmlspecialchars($categorie['name']) ?></h4>
                <p class="text-blue"><?= htmlspecialchars($categorie['Nombre de film par catégory']) ?></p>
            </div>
            <?php endforeach ?>
        </article>
</section>

<?php include_once('../partials/footer.php');
