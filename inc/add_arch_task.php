<?php

$idTask = isset($_POST['id']) ? $_POST['id'] : null;
$nameTask = isset($_POST['name']) ? $_POST['name'] : null;
$priorityTask = isset($_POST['priority']) ? $_POST['priority'] : null;

$statusTask = isset($_POST['status']) ? $_POST['status'] : null;
$descTask = isset($_POST['description']) ? $_POST['description'] : null;
$departTask = isset($_POST['department']) ? $_POST['department'] : null;
$timeCreateTask = isset($_POST['datetime_create']) ? $_POST['datetime_create'] : null;
$timeOutTask = isset($_POST['datetime_out']) ? $_POST['datetime_out'] : null;
$urlTask = isset($_POST['urltask']) ? $_POST['urltask'] : null;

$archTask = isset($_GET['archive']) ? $_GET['archive'] : null;

$update_date = date('Y-m-d H:i:s');

if($statusTask == '4'){

if($redactID){

  echo "<h1 align=\"center\" style=\"color: red\">Вы точно хотите перенести задание<br>$nametask в архив?</h1><br><center>
    <table border=\"0\">
    <tr><td><form method=\"get\" action=\"\">
    <input type='hidden' name='redactID' value=\"$redactID\">
    <input type='hidden' name='status' value=\"ok\">
    <button class=\"delete\" type=\"submit\" name=\"archive\" value=\"yes\">Да</button></form></td>
    <td><form method=\"get\" action=\"./tasks.php\">
    <button class=\"delete\" type=\"submit\" name=\"redactID\" value=\"$redactID\">НЕТ</button>
    </form></td></tr></table>";
}
if($archTask == 'yes'){
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
    if ($result) {
        header("Location: ./tasks.php?redactID=$idTask&status=ok&archive=yes");
    } else {
        echo '<p align="center" class="error">Неверные данные!</p>';
    }
}
}
}


?>