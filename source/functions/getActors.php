<?php
function getActors($db, $offset = 0)
{
    $sql = "SELECT * FROM `actor` LIMIT 15 OFFSET :offset";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countActors($db)
{
    // ecriture simplifier ++
    return $db->query("SELECT COUNT(*) FROM `actor`")->fetchColumn();
}
