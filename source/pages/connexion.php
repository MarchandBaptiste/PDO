<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/user/user.php';
$singIn = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            die("Données manquantes");
        }
        // faire des regex avec pregmatch
        // crypte le mot de passe 
        $password = password_hash($password, PASSWORD_BCRYPT);
        $user = setUser($db, $first_name, $last_name, $email, $username, $password);
        if ($user === true) {
            $singIn = true;
        }
    }
    if (isset($_POST['logIn'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $log = getUser($db, $username, $password);
        if ($log) {
            $_SESSION['logged']= $log;
            header('Location: /');
        }
    }
}

?>

<p>faut faire en sorte que le mot de passe sois de 8caractère au minimum</p>
<?php if ($singIn === true) { ?>
    <p>Vous êtes bien inscrit</p>
<?php } ?>
<div class="divLog">
    <section class="log">
        <h3>Ici vous pouvez vous Inscrire</h3>
        <form action="" method="POST">
            <div>
                <label for="first_name">Prénom : </label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    required />
            </div>
            <div>
                <label for="last_name">Nom : </label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    required />
            </div>
            <div>
                <label for="email">Email : </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required />
            </div>
            <div>
                <label for="username">Pseudo : </label>
                <input
                    type="text"
                    id="username"
                    name="username"
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
            <button type="submit" name="signIn">S'inscrire</button>
        </form>
    </section>
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
            <button type="submit" name="logIn">Connexion</button>
        </form>
    </section>
</div>
<?php include_once('../partials/footer.php'); ?>