<?php
function getCate($db)
{
    $sql = "SELECT `category`.`name`, COUNT(DISTINCT `film_category`.`film_id`) AS `Nombre de film par catégory`
    FROM `film_category`
    JOIN `category` ON `category`.`category_id` = `film_category`.`category_id`
    GROUP BY `category`.`name`
    ORDER BY `category`.`name` ASC;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
