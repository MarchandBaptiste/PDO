<?php
function getActors($db, $limit)
{
    $sql = "SELECT * FROM `actor` LIMIT :limit";
    $Stm = $db->prepare($sql);
    $Stm->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $Stm->execute();
    return $Stm->fetchAll(PDO::FETCH_ASSOC);
}
