<?php
function getMagasin($db)
{
    $sql = "SELECT 
    staff.first_name, 
    staff.last_name, 
    staff.email,
    address.address, 
    address.postal_code,
    city.city
    FROM `store` 
    JOIN `staff` 
    ON `staff`.`staff_id`=`store`.`manager_staff_id` 
    JOIN `address` 
    ON `address`.`address_id`=`store`.`address_id` 
    JOIN `city` 
    ON `city`.`city_id`=`address`.`city_id`; ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
