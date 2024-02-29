<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Архив заданий:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];
 
 $datetime = date('Y-m-d H:i:s');

 // Вывод данных из таблицы
 $sql = "SELECT * FROM `tasks` WHERE status_task='4' ORDER BY `datetime_create_task` DESC";
 $result = $pdo_conn->query($sql);
 $redactID = intval(isset($_GET['redactID']) ? $_GET['redactID'] : null);
 $newTask = isset($_GET['task']) ? $_GET['task'] : null;
 $viewTask = isset($_GET['viewID']) ? $_GET['viewID'] : null;

if($redactID) {
  $redact = "SELECT * FROM tasks WHERE `id_task` = '$redactID'";
  $redact_task = $pdo_conn->query($redact);
  $row_redact = $redact_task->fetch(PDO::FETCH_ASSOC);
  $idtask = $row_redact["id_task"];
  $nametask = $row_redact["name_task"];
  $prioritytask = $row_redact["priority_task"];
  $statustask = $row_redact["status_task"];
  $descripttask = $row_redact["description_task"];
  $departtask = $row_redact["department_task"];
  $datetime_create = $row_redact["datetime_create_task"];
  $datetime_out = $row_redact["datetime_out_task"];
  $urltask = $row_redact["url_task"];
  $departOutT = $departtask;

  if(isset($_POST['update'])){
    include "./inc/edit_task.php";
}

if(isset($_POST['close'])){
    header("Location: ./archive.php#$idtask");
}

echo "<h1 align=\"center\">Редактирование задания<br>$nametask</h1>";

if(isset($_POST['delete']) || isset($_GET['delete']) == 'ok'){
    include "./inc/delete_task.php";
}

echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"$idtask\">
    <input type='hidden' name='datetime_create' value='$datetime_create'>
    <input type='hidden' name='departOutT' value=\"$departOutT\">";
    if(isset($_GET['status']) == 'ok'){
        echo "<tr><td><h1 align=\"center\" style=\"color: green\">Обновлено успешно!</h1></td></tr>";
    }
echo "<tr><td><div align=\"right\"><button class=\"delete\" type=\"submit\" name=\"delete\" value=\"ok\">Удалить</button></div></td></tr>";

echo "<tr><td align=\"right\">Приоритет:&nbsp;<input type=\"checkbox\" name=\"priority\" value=\"Yes\"";
if ($prioritytask == 'Yes'){
 echo " checked";
} 
 echo "></td></tr>";

echo "<tr><td><p><font color=\"red\">*</font>Наименование задания:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='$nametask' required></td></tr>
    <tr><td><p>Описание задания:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''>$descripttask</textarea></td></tr>";

echo "<tr><td><p><font color='red'>*</font>Кому поручено задание подразделения/отдел:</p></td></tr>
<tr><td><select class=\"rounded\" name='department'>";

    $redact_dw = "SELECT * FROM department";
    $redact_dw = $pdo_conn->query($redact_dw);

    while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
{
echo "<option ";
if($row_dw['id_depart']=="$departtask") echo "selected=\"selected\"";
echo " class=\"rounded\" value=\"" . $row_dw["id_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
}

echo "<tr><td><p><font color='red'>*</font>Статус задания:</p></td></tr>
<tr><td><select class=\"rounded\" name='status'>";
    
    $redact_st = "SELECT * FROM status_tasks";
    $redact_st = $pdo_conn->query($redact_st);

    while($row_st = $redact_st->fetch(PDO::FETCH_ASSOC))
{
echo "<option ";
if($row_st['id_st']=="$statustask") echo "selected=\"selected\"";
echo " value=\"" . $row_st["id_st"]. "\">" . $row_st["name_st"]. "</option>";
}
echo "</select></td></tr>";

echo "<tr><td><p>Дата/время создания задания:</p></td></tr>
    <tr><td><p align=\"center\">$datetime_create</p></td></tr>
    <tr><td><p>Дата/время  назначения задания:</p></td></tr>
    <tr><td><input class=\"rounded\" type='datetime-local' inputmode=\"datetime-local\" name='datetime_out' value='$datetime_out'></td></tr>
    <!--<tr><td><p>Ссылка URL на файлы:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='urltask' value='$urltask'></td></tr>-->

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><button class=\"main\" type=\"submit\" name=\"update\">Сохранить</button>&nbsp;<button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr>
    <tr><td align=\"center\">
    </form></td></tr></table></center>";

$row_redact = null; 

} elseif(intval(isset($_GET['close']))){
  header('Location: ./archive.php#'.$_GET['close']);

} elseif($viewTask) {

  $viewID = "SELECT * FROM tasks WHERE `id_task` = '$viewTask'";
  $view_task = $pdo_conn->query($viewID);
  $row_view = $view_task->fetch(PDO::FETCH_ASSOC);
  $idtask = $row_view["id_task"];
  $nametask = $row_view["name_task"];
  $descripttask = $row_view["description_task"];
  $departtask = $row_view["department_task"];
  $datetime_create = $row_view["datetime_create_task"];
  $datetime_out = $row_view["datetime_out_task"];
  $urltask = $row_view["url_task"];

  if ($datetime_out <= $datetime){
    echo "<div align=\"center\"><font color=\"red\"><b>Просроченное задание!!!</b></font></div>";
  }

  echo "<center><table class=\"block-task\" border=\"0\">
    <tr bgcolor=\"#c6c6c6\"><td>Наименование задания:</td></tr>
    <tr><td align=\"center\"><b>$nametask</b></td></tr>
    <tr bgcolor=\"#c6c6c6\"><td>Описание задания:</td></tr>
    <tr><td>&nbsp;<b>$descripttask</b></td></tr>

    <tr bgcolor=\"#c6c6c6\"><td>Кому поручено задание подразделения/отдел:</td></tr>
    <tr><td align=\"center\">";
    
    $view_dt = "SELECT * FROM department";
    $view_dt = $pdo_conn->query($view_dt);
    while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
    {
    if($row_dt['id_depart']==$departtask) { echo "<b>" . $row_dt['name_depart']. "</b>"; }
    } 
    
    echo "</td></tr>
    <tr bgcolor=\"#c6c6c6\"><td>Дата/время создания задания:</td></tr>
    <tr><td align=\"center\"><p><b>$datetime_create</b></p></td></tr>
    <tr bgcolor=\"#c6c6c6\"><td>Дата/время выполнения задания:</td></tr>
    <tr><td align=\"center\">";
    if ($datetime_out <= $datetime){
      echo "<font color=\"red\"><b>$datetime_out</b></font>";
    } else {
    echo "<b>$datetime_out</b>";
    }
  echo "</td></tr>
  <tr bgcolor=\"#c6c6c6\"><td>История:</td></tr>";
  $histr = "SELECT * FROM tasks_history WHERE id_task=$idtask";
  $histr_task = $pdo_conn->query($histr);
  while($row_histr = $histr_task->fetch(PDO::FETCH_ASSOC)){
    $idTh = $row_histr['id_task'];
    $departTh = $row_histr['depart_th'];
    $datetimeTh = $row_histr['datetime_th'];
    $statusTh = $row_histr['status_th'];
    
    echo "<tr><td align=\"center\">Изменен: <b>$datetimeTh</b>";
    echo "&nbsp;&nbsp;";
    $view_st = "SELECT * FROM status_tasks";
    $view_st = $pdo_conn->query($view_st);
    while($row_st = $view_st->fetch(PDO::FETCH_ASSOC))
    {
    if($row_st['id_st']==$statusTh) { echo "<font color=\"". $row_st['color_st']. "\"><b>". $row_st["name_st"]."</b></font>"; }
    }
    echo "&nbsp;&nbsp;";
    $view_dt = "SELECT * FROM department";
    $view_dt = $pdo_conn->query($view_dt);
    while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
    {
    if($row_dt['id_depart']==$departTh) { echo "<b>" . $row_dt['name_depart']. "</b>"; }
    }
   
    echo "</td></tr>";
  }
    echo "<tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><form method='GET'><button class=\"main\" type=\"submit\" name=\"redactID\" value=\"$idtask\">Редактировать</button>&nbsp;<button class=\"main\" type=\"submit\" name=\"close\" value=\"$idtask\">Назад</button></form></td></tr>
    <tr></table></center>";


} else {

  if ($result) {
    // Вывод всех заданий
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<div id=\"" . $row["id_task"]. "\" class=\"block-task\">";
        echo "<div class=\"post-content\">";
        echo "<div class=\"category\"><b>Назначено:</b>&nbsp;" . $row["datetime_create_task"]. "&nbsp;<b>Кому:</b>&nbsp;<a href=\"?viewID=" . $row["id_task"]. "\">";
        
        $view_dt = "SELECT * FROM department";
        $view_dt = $pdo_conn->query($view_dt);
        while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
        {
          if($row_dt['id_depart']==$row['department_task']) { echo $row_dt['name_depart']; }
        } 
        echo "</a><div align=\"right\"><b>Статус:&nbsp;";
      
        $histr = "SELECT * FROM tasks_history WHERE id_task=$row[id_task]";
        $histr_task = $pdo_conn->query($histr);
        $row_histr = $histr_task->fetch(PDO::FETCH_ASSOC);
        $idTh = $row_histr['id_task'];
        $datetimeTh = $row_histr['datetime_th'];
        $statusTh = $row_histr['status_th'];

        $view_st = "SELECT * FROM status_tasks";
        $view_st = $pdo_conn->query($view_st);
        while($row_st = $view_st->fetch(PDO::FETCH_ASSOC))
        {
          if($row_st['id_st']==$statusTh) { echo "<font color=\"". $row_st['color_st']. "\">". $row_st["name_st"]."</font>"; }
        } 
      
        echo "</b></div></div>";
        if ($row['priority_task'] == 'Yes') {
          echo "<div align=\"right\"><font color=\"green\"><b>Приоритетное задание!</b></font></div>";
        }
        if ($row["datetime_out_task"] <= $datetime){
          echo "<div align=\"right\"><font color=\"red\"><b>Просроченное задание!!!</b></font></div>";
        }
        echo "<h2 class=\"post-title\"><a href=\"?viewID=" . $row["id_task"]. "\">" . $row["name_task"]. "</a></h2>";
        echo "<p><b>Описание:</b> " . $row["description_task"]. "</p>";
        if ($row["datetime_out_task"] <= $datetime){
          echo "<p><font color=\"red\"><b>Время выполнения задания: " . $row["datetime_out_task"]. "</b></font></p>";
        } else {
          echo "<p><b>Время выполнения задания:</b> " . $row["datetime_out_task"]. "</p>";
        }
        echo "<div class=\"post-footer\"><a title=\"Просмотреть задание " . $row["name_task"]. "\" class=\"more-link\" href=\"?viewID=" . $row["id_task"]. "\">Просмотреть " . $row["name_task"]. "</a></div></div><br>";
        echo "</div>";
    }
  
  } else {
    echo "<h2 class=\"post-title\">Нет заданий в архиве</h2>";
  }
  }


?>

    </article>
  </div> <!-- конец div class="posts-list"-->

<? require_once "./inc/right_block.php"; ?>
</div> <!-- конец div class="container"-->

<? 
include_once "./inc/footer.php"; 
$result = null;
$pdo_conn = null;
?>

</body>
</html>
