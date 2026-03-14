<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/user/user.php';

// Initialisation des variables AVANT tout traitement
$singIn = false;
$sentance = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = db();

    if (isset($_POST['signIn'])) {
        // on récupère les données du formulaire et on nettoie
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name   = filter_input(INPUT_POST, 'last_name',  FILTER_SANITIZE_SPECIAL_CHARS);
        $email       = filter_input(INPUT_POST, 'email',      FILTER_SANITIZE_EMAIL);
        $username    = filter_input(INPUT_POST, 'username',   FILTER_SANITIZE_SPECIAL_CHARS);
        $password    = filter_input(INPUT_POST, 'password',   FILTER_DEFAULT);

        // validation des champs
        $first_name_valid = (
            !empty(trim($first_name)) &&
            strlen($first_name) >= 2 &&
            strlen($first_name) <= 50 &&
            preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $first_name)
        );
        $last_name_valid = (
            !empty(trim($last_name)) &&
            strlen($last_name) >= 2 &&
            strlen($last_name) <= 50 &&
            preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $last_name)
        );
        $email_valid    = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
        $username_valid = (
            !empty(trim($username)) &&
            strlen($username) >= 2 &&
            strlen($username) <= 16 &&
            preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $username)
        );

        if (!$first_name_valid || !$last_name_valid || !$email_valid || !$username_valid || !$password) {
            $sentance = 'Données manquantes ou invalides';
            $singIn = false;
        } else {
            // vérification de la solidité du mot de passe
            if (strlen($password) < 8) {
                $message = 'Le mot de passe est trop court, il doit comporter au moins 8 caractères';
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins une majuscule';
            } elseif (!preg_match('/[a-z]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins une minuscule';
            } elseif (!preg_match('/[1-9]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins un chiffre';
            } else {
                // mot de passe valide → insertion
                $password = password_hash($password, PASSWORD_BCRYPT);
                $user = setUser($db, $first_name, $last_name, $email, $username, $password);
                if ($user === true) {
                    $singIn   = true;
                    $sentance = 'Vous êtes inscrit';
                } else {
                    $singIn   = false;
                    $sentance = "L'inscription a échoué";
                }
            }
        }
    }

    // connexion
    if (isset($_POST['logIn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $log = getUser($db, $username, $password);
        if ($log) {
            $_SESSION['logged'] = $log;
            header('Location: /');
            exit();
        } else {
            $sentance = 'Mot de passe ou identifiant incorrect';
        }
    }
}
?>

<div class="divLog">
    <!-- inscription -->
    <section class="log">
        <?php if (isset($_POST['signIn'])) { ?>
            <?php if ($singIn === true) { ?>
                <p class="valid"><?= $sentance ?></p>
            <?php } elseif (!empty($sentance)) { ?>
                <p class="error"><?= $sentance ?></p>
            <?php } ?>
        <?php } ?>
        <h3>Inscription</h3>
        <form action="" method="POST">
            <div>
                <label for="first_name">Prénom : </label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="<?= isset($_POST['signIn']) ? htmlspecialchars($first_name ?? '') : '' ?>"
                    required />
            </div>
            <div>
                <label for="last_name">Nom : </label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="<?= isset($_POST['signIn']) ? htmlspecialchars($last_name ?? '') : '' ?>"
                    required>
            </div>
            <div>
                <label for="email">Email : </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= isset($_POST['signIn']) ? htmlspecialchars($email ?? '') : '' ?>"
                    required />
            </div>
            <div>
                <label for="username">Pseudo (16 caractères MAX) : </label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= isset($_POST['signIn']) ? htmlspecialchars($username ?? '') : '' ?>"
                    required />
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required />
            </div>
            <?php if (isset($_POST['signIn']) && !empty($message)) { ?>
                <p class="error"><?= $message ?></p>
            <?php } ?>
            <button type="submit" name="signIn">S'inscrire</button>
        </form>
    </section>

    <!-- connexion -->
    <section class="log">
        <?php if (isset($_SESSION['logged'])) { ?>
            <p class="valid">Vous êtes bien connecté</p>
        <?php } ?>
        <h3>Connexion</h3>
        <form action="" method="POST">
            <div>
                <label for="username">Pseudo : </label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= isset($_POST['logIn']) ? htmlspecialchars($username ?? '') : '' ?>"
                    required />
            </div>
            <div>
                <label for="password">Mot de passe : </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required />
            </div>
            <?php if (isset($_POST['logIn']) && !empty($sentance)) { ?>
                <p class="error"><?= $sentance ?></p>
            <?php } ?>
            <button type="submit" name="logIn">Connexion</button>
        </form>
    </section>
</div>
<?php include_once('../partials/footer.php'); ?>