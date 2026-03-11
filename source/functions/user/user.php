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
    // verifier que le execute a bien été affecter avant de return true
    return true;
}
function getUser($db, $username, $password)
{
    $sql = "SELECT *
    FROM `staff`
    WHERE `username` = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();
    if (password_verify($password, $user['password']) === true) {
        return array(
            "lastname" => $user['last_name'],
            "firstname" => $user['first_name'],
            "username"=> $user['username']
        );
    } else {
        return false;
    }
}