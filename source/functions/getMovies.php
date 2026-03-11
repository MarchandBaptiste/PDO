<?php
function getMovies($db, $limit) {
    $limit = filter_var($limit, FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `film` LIMIT :limit";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}