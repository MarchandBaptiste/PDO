<?php include_once __DIR__ . '/../partials/header.php'; ?>

    <h2>Bienvenue sur Sakila</h2>
    <p>
        Cette application a été développée dans le cadre du TD PDO 01. </p>
    <p>
        Elle exploite la base de données Sakila, une base de démonstration MySQL représentant un système de location de films.
    </p>
    <p>
        L'objectif de ce TD était d'apprendre à connecter une application PHP à une base de données via l'extension PDO, et de manipuler les données à l'aide de requêtes SQL variées : sélections simples, jointures entre tables, fonctions d'agrégation, et pagination.
        Le site te permet de consulter le catalogue de films disponibles à la location, de parcourir la liste des acteurs et leur filmographie, de localiser les magasins avec leurs informations de contact, d'accéder aux données financières par boutique, et d'explorer les films par catégorie.
        Le développement a suivi le principe DRY (Don't Repeat Yourself) : connexion centralisée, includes réutilisables, et requêtes testées avant intégration.
    </p>
    <p><span>Chose a faire : </span>cooki pour mettre un mode sombre ou claire, faire un UX/UI correcte pour l'ui mettre des icons, moteur de recherche, faire pour les film la pagination en affichant 15 par 15 les films</p>
    <?php if (isset($_SESSION['logged'])){ ?>
        <p>Bonjour <?= $_SESSION['logged']['username'] ?></p>
    <?php } ?>
<!-- mettre des mettre coocki pour les thème -->
<?php include_once __DIR__ . '/../partials/footer.php'; ?>