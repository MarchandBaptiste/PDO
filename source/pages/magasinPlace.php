<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getMagasin.php';
$db = db();
$magasins = getMagasin($db);
?>
<h2>Voici l'implantation des magasins</h2>
<section>
    <?php foreach ($magasins as $magasin) : ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($magasin['first_name']) . ' ' . htmlspecialchars($magasin['last_name']) ?></h3>
            <p><span>Email : </span><?= htmlspecialchars($magasin['email']) ?></p>
            <p><span>Address : </span><?= htmlspecialchars($magasin['address']) ?></p>
            <p><span>Ville : </span><?= htmlspecialchars($magasin['city']) ?></p>
        </div>
    <?php endforeach ?>
</section>
<?php include_once('../partials/footer.php'); ?>