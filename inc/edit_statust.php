<?php
// Обновляем данные по статусу заданий.

$idStatusT = isset($_POST['id']);
$nameStatusT = isset($_POST['name']) ? $_POST['name'] : null;
$colorStatusT = isset($_POST['color']) ? $_POST['color'] : null;

  if($redactID){
    if($nameStatusT) {
    $query = $pdo_conn->prepare("UPDATE status_tasks SET name_st=:name,color_st=:color WHERE `id_st`=:idStatusT");
    $query->bindParam(":idStatusT", $redactID, PDO::PARAM_STR);
    $query->bindParam(":name", $nameStatusT, PDO::PARAM_STR);
    $query->bindParam(":color", $colorStatusT, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        header("Location: ./statustasks.php?redactID=$redactID&status=ok");
    } else {
        echo '<p align="center" class="error">Неверные данные!</p>';
    }
}
}
?>