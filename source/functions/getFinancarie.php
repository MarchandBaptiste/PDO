<?php
function getfinancarie($db)
{
    $sql = "SELECT `store`.`store_id`, 
    COUNT(`payment`.`rental_id`) AS 'nbMovie', 
    SUM(`payment`.`amount`) AS 'ca' 
    FROM `store` JOIN `staff` ON `store`.`store_id` = `staff`.`store_id` 
    JOIN `payment` ON `staff`.`staff_id`=`payment`.`staff_id` 
    GROUP BY store_id;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
