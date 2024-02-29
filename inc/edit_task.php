<?php

$idTask = isset($_POST['id']) ? $_POST['id'] : null;
$nameTask = isset($_POST['name']) ? $_POST['name'] : null;
$priorityTask = isset($_POST['priority']) ? $_POST['priority'] : null;

$statusTask = isset($_POST['status']) ? $_POST['status'] : null;
$descTask = isset($_POST['description']) ? $_POST['description'] : null;
$departTask = isset($_POST['department']) ? $_POST['department'] : null;
$departOutT = isset($_POST['departOutT']) ? $_POST['departOutT'] : null;
$timeCreateTask = isset($_POST['datetime_create']) ? $_POST['datetime_create'] : null;
$timeOutTask = isset($_POST['datetime_out']) ? $_POST['datetime_out'] : null;
$urlTask = '1';

$archTask = isset($_GET['archive']) ? $_GET['archive'] : null;

$update_date = date('Y-m-d H:i:s');

if($idTask){
    if($nameTask) {
    $query = $pdo_conn->prepare("UPDATE tasks SET name_task=:name,priority_task=:priority,status_task=:status,description_task=:description,department_task=:department,datetime_create_task=:datetime_create,datetime_out_task=:datetime_out,url_task=:urltask WHERE `id_task`=:idTask");
    $query->bindParam(":idTask", $idTask, PDO::PARAM_STR);
    $query->bindParam(":name", $nameTask, PDO::PARAM_STR);
    $query->bindParam(":priority", $priorityTask, PDO::PARAM_STR);
    $query->bindParam(":status", $statusTask, PDO::PARAM_STR);
    $query->bindParam(":description", $descTask, PDO::PARAM_STR);
    $query->bindParam(":department", $departTask, PDO::PARAM_STR);
    $query->bindParam(":datetime_create", $timeCreateTask, PDO::PARAM_STR);
    $query->bindParam(":datetime_out", $timeOutTask, PDO::PARAM_STR);
    $query->bindParam(":urltask", $urlTask, PDO::PARAM_STR);
    $result = $query->execute();

    $query2 = $pdo_conn->prepare("INSERT INTO tasks_history(id_task,depart_th,depart_out_th,datetime_th,status_th) VALUES (:idTh,:departTh,:departOutTh,:datetimeTh,:statusTh)");
    $query2->bindParam(":idTh", $idTask, PDO::PARAM_STR);
    $query2->bindParam(":departTh", $departTask, PDO::PARAM_STR);
    $query2->bindParam(":departOutTh", $departOutT, PDO::PARAM_STR);
    $query2->bindParam(":datetimeTh", $update_date, PDO::PARAM_STR);
    $query2->bindParam(":statusTh", $statusTask, PDO::PARAM_STR);
    $result2 = $query2->execute();

    if ($result && $result2) {
        header("Location: ./tasks.php?redactID=$idTask&status=ok");
    } else {
        echo '<p align="center" class="error">Неверные данные!</p>';
    }
}
}


?>