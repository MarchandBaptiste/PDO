<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/user/user.php';
// pour créé un compte
$singIn = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $boolLogIn = false;
    $setValidPasswor = false;
    $setValidUsername = false;
    $db = db();
    if (isset($_POST['signIn'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        // mettre un filter validate
        if (!$first_name || !$last_name || !$email || !$username || !$password) {
            // champ invalide ou manquant
            die('Données manquantes ou invalides');
        }

        // faire des regex avec pregmatch

        // vérification de la solidité du mot de passe 
        if ($setValidPasswor === false) {

            if (strlen($password) < 8) {
                $message = 'Le mot de passe est trop court, il doit comporter au moins 8 caractères';
            } elseif (!preg_match('/[A-Z]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins une majuscule';
            } elseif (!preg_match('/[a-z]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins une minuscule';
            } elseif (!preg_match('/[1-9]/', $password)) {
                $message = 'Le mot de passe doit comporter au moins un chiffre';
            } else {
                $setValidPasswor = true;
            }
        }
        // validité du usename car il y'a une limite de taille
        if ($setValidUsername === false) {
            if (strlen($username) > 16) {
                $message = 'Le surnom est trop long';
            } else {
                $setValidUsername = true;
            }
        }
        // si c'est valider alors on envoye en enregistrement
        if ($setValidPasswor === true && $setValidUsername === true) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $user = setUser($db, $first_name, $last_name, $email, $username, $password);
            if ($user === true) {
                $singIn = true;
                $sentance = 'Vous êtes inscrit';
            } else {
                $singIn = false;
                $sentance = 'L\'inscription a échouer';
            }
        }
    }

    // pour se connecter 
    if (isset($_POST['logIn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $log = getUser($db, $username, $password);
        if ($log) {
            $boolLogIn = true;
            $_SESSION['logged'] = $log;
            header('Location: /');
            exit();
        } else {
            $boolLogIn = false;
            $sentance = 'Mot de passe ou identifiant incorecte';
        }
    }
}
?>

<div class="divLog">
    <!-- inscription -->
    <section class="log">
        <?php if ($singIn === true) { ?>
            <p><?= $sentance ?></p>
        <?php } ?>
        <h3>Ici vous pouvez vous Inscrire</h3>
        <form action="" method="POST">
            <div>
                <label for="first_name">Prénom : </label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="<?= $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn']) ? htmlspecialchars($first_name) : '' ?>"
                    required />
            </div>
            <div>
                <label for="last_name">Nom : </label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="<?= $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn']) ? htmlspecialchars($last_name) : '' ?>"
                    required
                    </div>
                <div>
                    <label for=" email">Email : </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn']) ? htmlspecialchars($email) : '' ?>"
                        required />
                </div>
                <div>
                    <label for="username">Pseudo(16 charactères MAX) : </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn']) ? htmlspecialchars($username) : '' ?>"
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
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signIn']) && ($setValidPasswor === false || $setValidUsername === false)) { ?>
                    <p><?= $message ?></p>
                <?php } ?>
                <button type="submit" name="signIn">S'inscrire</button>
        </form>
    </section>

    <!-- connexion -->
    <section class="log">
        <?php if (isset($_SESSION["logged"])) { ?>
            <p>Vous êtes bien connecter</p>
        <?php } ?>
        <h3>Ici vous pouvez vous connecter</h3>
        <form action="" method="POST">
            <div>
                <label for="username">Pseudo : </label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logIn']) ? htmlspecialchars($username) : '' ?>"
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
            <!-- c'est plus propre d'utiliser la variable car ca évite les bug de est-ce que le formulaire est envoyer ou non -->
            <?php if (isset($sentance)) { ?>
                <p><?= $sentance ?></p>
            <?php } ?>
            <button type="submit" name="logIn">Connexion</button>
        </form>
    </section>
</div>
<?php include_once('../partials/footer.php'); ?>