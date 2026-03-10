<?php 
function db() {
    try {
        $user = "root";
        $pwd = "";
        $dbname = "salika";
        $dsn = "mysql:host=localhost:3306;dbname=" . $dbname . ";charset=utf8";
        $db = new PDO($dsn, $user, $pwd);
        return $db;
    } catch (PDOException $error) {
        var_dump($error);
        die;
    }
}