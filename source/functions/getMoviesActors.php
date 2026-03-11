<?php 
function getMoviesActors($db, $id){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM `actor` 
    JOIN `film_actor` ON `actor`.`actor_id`=`film_actor`.`actor_id`
    JOIN `film` ON `film`.`film_id`=`film_actor`.`film_id`
    WHERE `actor`.`actor_id`=:id;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>