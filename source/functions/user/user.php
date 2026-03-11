<?php

function setUser($db, $first_name, $last_name, $email, $username, $password)
{
    var_dump($first_name, $last_name, $email, $username, $password);
    $sql = "INSERT INTO `staff` (`first_name`,`last_name`,`address_id`,`email`,`store_id`,`username`,`password`)
    VALUES (:first_name, :last_name,2, :email, 2, :username, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    return true;
}
function getUser($db, $username, $password) {
    $sql = "SELECT `first_name`, `last_name`
    FROM `staff`
    WHERE `username` = :username AND `password` = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    return true;
}
