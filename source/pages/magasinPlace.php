<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMagasin.php';
$db = db();
$magasins = getMagasin($db);
?>
<h2>Implantation des magasins</h2>
<section class="data">
    <?php foreach ($magasins as $magasin) : ?>
        <div class="card-shop">
            <h3><span>Sakila Store - </span><?= htmlspecialchars($magasin['city']) ?></h3>
            <p>Manager : <?php echo htmlspecialchars($magasin['first_name']) . ' ' . htmlspecialchars($magasin['last_name']) ?></p>
            <p><span>📧 </span><a href="mailto:<?= htmlspecialchars($magasin['email']) ?>"><?= htmlspecialchars($magasin['email']) ?></a></p>
            <p class="mutedText"><span>📍 </span><?= htmlspecialchars($magasin['address']) . ' ' . htmlspecialchars($magasin['city']) . ' ' . htmlspecialchars($magasin['postal_code'])?></p>
        </div>
    <?php endforeach ?>
</section>
<?php include_once('../partials/footer.php'); ?>