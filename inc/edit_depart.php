<?php
// Обновляем данные по Подразделению.

$idDepart = isset($_POST['id']);
$nameDepart = isset($_POST['name']) ? $_POST['name'] : null;
$descDepart = isset($_POST['desc']) ? $_POST['desc'] : null;
$codeDepart = isset($_POST['coded']) ? $_POST['coded'] : null;

  if($redactID){
    if($nameDepart) {
    $query = $pdo_conn->prepare("UPDATE department SET name_depart=:name,description_depart=:desc,code_depart=:code WHERE `id_depart`=:idDepart");
    $query->bindParam(":idDepart", $redactID, PDO::PARAM_STR);
    $query->bindParam(":name", $nameDepart, PDO::PARAM_STR);
    $query->bindParam(":desc", $descDepart, PDO::PARAM_STR);
    $query->bindParam(":code", $codeDepart, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        header("Location: ./department.php?redactID=$redactID&status=ok");
    } else {
        echo '<p align="center" class="error">Неверные данные!</p>';
    }
}
}
?>