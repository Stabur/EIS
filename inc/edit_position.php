<?php

// Обновляем данные по Должности.

$idPosition = isset($_POST['id']) ? $_POST['id'] : null;
$namePosition = isset($_POST['name']) ? $_POST['name'] : null;
$departPosition = isset($_POST['department']) ? $_POST['department'] : null;
$descPosition = isset($_POST['description']) ? $_POST['description'] : null;

  if($redactID){
    if($namePosition) {
    $query = $pdo_conn->prepare("UPDATE position_worker SET name_position=:name,department_position=:depart,description_position=:descript WHERE `id_position`=:idPosition");
    $query->bindParam(":idPosition", $redactID, PDO::PARAM_STR);
    $query->bindParam(":name", $namePosition, PDO::PARAM_STR);
    $query->bindParam(":depart", $departPosition, PDO::PARAM_STR);
    $query->bindParam(":descript", $descPosition, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        header("Location: ./positions.php?redactID=$redactID&status=ok");
    } else {
        echo '<p align="center" class="error">Неверные данные!</p>';
    }
}
}
?>