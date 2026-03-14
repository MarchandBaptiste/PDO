<?php
// function getMovies($db, $limit) {
//     $limit = filter_var($limit, FILTER_SANITIZE_NUMBER_INT);
//     $sql = "SELECT * FROM `film` LIMIT :limit";
//     $stmt = $db->prepare($sql);
//     $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
//     $stmt->execute();
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }

function getMovies($db, $offset = 0)
{
    $sql = "SELECT * FROM `film` LIMIT 15 OFFSET :offset";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countMovies($db)
{
    // ecriture simplifier ++
    return $db->query("SELECT COUNT(*) FROM `film`")->fetchColumn();
}
