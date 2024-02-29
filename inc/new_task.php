<?php

$newTask = isset($_POST['newTask']) ? $_POST['newTask'] : null;
$nameTask = isset($_POST['name']) ? $_POST['name'] : null;
$priorityTask = isset($_POST['priority']) ? $_POST['priority'] : null;
$statusTask = isset($_POST['status']) ? $_POST['status'] : null;
$descTask = isset($_POST['description']) ? $_POST['description'] : null;
$departTask = isset($_POST['department']) ? $_POST['department'] : null;
$timeCreateTask = isset($_POST['datetime_create']) ? $_POST['datetime_create'] : null;
$timeOutTask = isset($_POST['datetime_out']) ? $_POST['datetime_out'] : null;
$urlTask = isset($_POST['urltask']) ? $_POST['urltask'] : null;

$create_date = date('Y-m-d H:i:s');

echo "<h2 align=\"center\">Новое задание</h2>";
echo "<div align=\"center\"><font color=\"green\"><b>дата/время создания задания<br>$create_date</b></font></div>";

if(isset($_POST['close'])){
    header("Location: ./tasks.php");
}

if($newTask == 'create'){
    if($nameTask) {
    $query = $pdo_conn->prepare("INSERT INTO tasks(name_task,priority_task,status_task,description_task,department_task,datetime_create_task,datetime_out_task,url_task) VALUES (:name,:priority,:status,:description,:department,:datetime_create,:datetime_out,:urltask)");
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
            $select = "SELECT id_task FROM tasks ORDER BY id_task DESC LIMIT 1";
            $select_task = $pdo_conn->query($select);
            $row_st = $select_task->fetch(PDO::FETCH_ASSOC);
            $idST = $row_st['id_task'];

            $query2 = $pdo_conn->prepare("INSERT INTO tasks_history(id_task,depart_th,depart_out_th,datetime_th,status_th) VALUES (:idTh,:departTh,:departOutTh,:datetimeTh,:statusTh)");
            $query2->bindParam(":idTh", $idST, PDO::PARAM_STR);
            $query2->bindParam(":departTh", $departTask, PDO::PARAM_STR);
            $query2->bindParam(":departOutTh", $departTask, PDO::PARAM_STR);
            $query2->bindParam(":datetimeTh", $timeCreateTask, PDO::PARAM_STR);
            $query2->bindParam(":statusTh", $statusTask, PDO::PARAM_STR);
            $result2 = $query2->execute();
        echo "<br><h1 align=\"center\" style=\"color: green\">Новое задание создано!</h1><br><h2 align=\"center\"><b>Ждите...</b></h2>";
        header("Refresh:1; url=./tasks.php");
    } else {
        echo '<p class="error">Неверные данные!</p>';
    }
}

} else {
    echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"\">
    <input type='hidden' name='datetime_create' value='$create_date'>
    <tr><td align=\"right\">Приоритет:&nbsp;<input type=\"checkbox\" name=\"priority\" value=\"Yes\"></td></tr>
    <tr><td><p><font color=\"red\">*</font>Наименование задания:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='' required></td></tr>
    <tr><td><p>Описание задания:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''></textarea></td></tr>";

echo "<tr><td><p><font color='red'>*</font>Кому поручено задание подразделение/отдел:</p></td></tr>
<tr><td><select class=\"rounded\" name='department'>";
    
    $redact_dw = "SELECT * FROM department";
    $redact_dw = $pdo_conn->query($redact_dw);

    while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
{
echo "<option value=\"" . $row_dw["id_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
}
echo "</select></td></tr>";

echo "<tr><td><p><font color='red'>*</font>Статус задания:</p></td></tr>
<tr><td><select class=\"rounded\" name='status'>";
    
    $redact_st = "SELECT * FROM status_tasks";
    $redact_st = $pdo_conn->query($redact_st);

    while($row_st = $redact_st->fetch(PDO::FETCH_ASSOC))
{
echo "<option value=\"" . $row_st["id_st"]. "\">" . $row_st["name_st"]. "</option>";
}
echo "</select></td></tr>";

echo "<tr><td><p>К какой дате/времени выполнить задание:</p></td></tr>
    <tr><td><input class=\"rounded\" type=\"datetime-local\" name='datetime_out' value=''></td></tr>
    <tr><td><p>Ссылка URL на файлы:</p></td></tr>
    <tr><td><input class=\"rounded\" type=\"text\" inputmode=\"text\" name='urltask' value=''></td></tr>

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"newTask\" value=\"create\">Создать</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr></table></td></tr>
    <tr><td align=\"center\">
    </form></td></tr></table></center>";
}

?>