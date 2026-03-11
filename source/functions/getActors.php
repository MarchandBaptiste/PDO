<?php
function getActors($db, $limit)
{   
    $limit = filter_var($limit, FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `actor` LIMIT :limit";
    $Stm = $db->prepare($sql);
    $Stm->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $Stm->execute();
    return $Stm->fetchAll(PDO::FETCH_ASSOC);
}
