<?php 
function db() {
    try {
        $user = "root";
        $pwd = "";
        $dbname = "salika";
        $dsn = "mysql:host=localhost:3306;dbname=" . $dbname . ";charset=utf8";
        $db = new PDO($dsn, $user, $pwd);
        // dans le new PDO on peut ajouter ce parametre : [PDO::ATTR_DEFAULT_FETCH_MODE=>POD::FETCH_ASSOC] pour ne plus mettre de fetchALL partout
        return $db;
    } catch (PDOException $error) {
        var_dump($error);
        die;
    }
}