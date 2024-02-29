<!DOCTYPE html>
<html>

<?php
include_once "./inc/func_sess.php";
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 
?>
<div class="container">
      <div class="posts-list-taskdep">
    <article class="post">

<?php

$datetime = date('Y-m-d H:i:s');
$_SESSION['datetime'] = $datetime;

$id = intval(isset($_GET['id']) ? $_GET['id'] : null);
$viewID = intval(isset($_GET['viewID']) ? $_GET['viewID'] : null);
$idTask = intval(isset($_GET['idTask']) ? $_GET['idTask'] : null);
$idDepart = intval(isset($_GET['idDepart']) ? $_GET['idDepart'] : null);
$goDepart = intval(isset($_GET['goDepart']) ? $_GET['goDepart'] : null);

if($viewID){
    $view = "SELECT * FROM tasks WHERE `id_task` = '$viewID'";
    $view_task = $pdo_conn->query($view);
    $row_view = $view_task->fetch(PDO::FETCH_ASSOC);
    $idtask = $row_view["id_task"];
    $nametask = $row_view["name_task"];
    $prioritytask = $row_view["priority_task"];
    $statustask = $row_view["status_task"];
    $descripttask = $row_view["description_task"];
    $departtask = $row_view["department_task"];
    $datetime_create = $row_view["datetime_create_task"];
    $datetime_out = $row_view["datetime_out_task"];
    $urltask = $row_view["url_task"];
    $departOutT = $departtask;
    
    $histr = "SELECT * FROM tasks_history WHERE id_task=$idtask ORDER BY `datetime_th` DESC";
    $histr_task = $pdo_conn->query($histr);
    $row_histr = $histr_task->fetch(PDO::FETCH_ASSOC);
    $departTh = $row_histr['depart_th'];
    $departOutTh = $row_histr['depart_out_th'];
    $datetimeTh = $row_histr['datetime_th'];
    $statusTh = $row_histr['status_th'];

    $_SESSION['idTask'] = $idtask;
    $_SESSION['statusTask'] = $departOutT;

    $_SESSION['status'] = '3';

    $_SESSION['idDepartOut'] = $departtask;

    if(intval(isset($_POST['doneTask']))){
      include_once "./inc/status_task.php";
    }

    if($idTask && $idDepart){
      include_once "./inc/status_task.php";
    }

    if(intval(isset($_POST['closeTask']))){
      header("Location: ./tasks_view_dep.php?id=$departTh");
    }

    echo "<h2 class=\"post-title\" align=\"center\">";
    $view_dt = "SELECT * FROM department";
        $view_dt = $pdo_conn->query($view_dt);
        while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
        {
        if($row_dt['id_depart']==$departTh) { echo "<b>" . $row_dt['name_depart']. "</b>"; }
        } 
    echo "</h2>";

    if ($datetime_out <= $datetime){
        echo "<center><div class=\"block-task\"><font color=\"red\"><b>Просроченное задание!!!</b></font>";
      }
    
      echo "<table border=\"0\" width=\"80%\">
        <tr bgcolor=\"#c6c6c6\"><td>Наименование задания:</td></tr>
        <tr><td align=\"center\"><b>$nametask</b></td></tr>
        <tr bgcolor=\"#c6c6c6\"><td>Описание задания:</td></tr>
        <tr><td>&nbsp;$descripttask</td></tr>
    
        <tr bgcolor=\"#c6c6c6\"><td>Кому поручено задание подразделения/отдел:</td></tr>
        <tr><td align=\"center\">";

        $view_dt = "SELECT * FROM department";
        $view_dt = $pdo_conn->query($view_dt);
        while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
        {
        if($row_dt['id_depart']==$departTh) { echo "<b>" . $row_dt['name_depart']. "</b>"; }
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
        <!--<tr bgcolor=\"#c6c6c6\"><td>Ссылка URL на файлы:</td></tr>
        <tr><td align=\"center\"><a href=''>$urltask</a></td></tr>-->
    
        <tr><td>&nbsp;</td></tr>
        <tr align=\"center\"><td><form method='post'><button class=\"main\" type=\"submit\" name=\"doneTask\" value=\"15\">Выполненно</button></form></td></tr>";
        if($departtask!=3){
        echo "<tr align=\"center\"><td><form method='get'><button class=\"main\" type=\"submit\" name=\"goDepart\" value=\"$idtask\">Передать подразделению</button></form></td></tr>";
        }
      echo "<tr align=\"center\"><td><form method='post'><button class=\"main\" type=\"submit\" name=\"closeTask\">Закрыть</button></form></td></tr>
        <tr></table></div></center>";
    
} elseif(isset($_GET['goDepart'])) {
  $viewT = "SELECT * FROM tasks WHERE `id_task` = '$goDepart'";
  $view_task = $pdo_conn->query($viewT);
  $row_view = $view_task->fetch(PDO::FETCH_ASSOC);
  $idtask = $row_view["id_task"];
  $nametask = $row_view["name_task"];
  echo "<h1 align=\"center\">Какому подразделению передать задание $nametask?</h1><br>";
  $view = "SELECT * FROM department";
  $view_depart = $pdo_conn->query($view);
  echo "<form method='get'><div align=\"center\">
        <input type='hidden' name='viewID' value=\"$goDepart\">
        <input type='hidden' name='idTask' value=\"$idtask\">";
  while($rowD = $view_depart->fetch(PDO::FETCH_ASSOC)) {
      echo "<button class=\"main\" title=\"Подразделение " . $rowD["name_depart"]. "\" type=\"submit\" name=\"idDepart\" value=\"" . $rowD["id_depart"]. "\">" . $rowD["name_depart"]. "</button><br>";
    }
    echo "</div></form>";
} elseif($id) {
  header("Refresh:60; url=./tasks_view_dep.php?id=$id");
  $view = "SELECT * FROM department WHERE `id_depart` = '$id'";
  $view_depart = $pdo_conn->query($view);
  $view_depart = $view_depart->fetch(PDO::FETCH_ASSOC);
  $idDepart = $view_depart["id_depart"];
  $nameDepart = $view_depart["name_depart"];
  $_SESSION['idDepart'] = $idDepart;
  $_SESSION['nameDepart'] = $nameDepart;

  echo "<h2 class=\"post-title\" align=\"center\">$nameDepart</h2>";

  $result = "SELECT * FROM tasks WHERE `department_task`='$idDepart' AND status_task!='4' ORDER BY `datetime_create_task` DESC";
  $result = $pdo_conn->query($result);

  echo "<center>";

  if($result->rowCount() > 0){
  
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<div id=\"" . $row["id_task"]. "\" class=\"block-task\">";
    echo "<div class=\"post-content\">";
    echo "<div class=\"category\"><b>Назначено:</b>&nbsp;" . $row["datetime_create_task"]. "&nbsp;<b>Кому:</b>&nbsp;<a href=\"?viewID=" . $row["id_task"]. "\">";

    $histr = "SELECT * FROM tasks_history WHERE id_task=$row[id_task] AND depart_th=$idDepart ORDER BY `datetime_th` DESC";
    $histr_task = $pdo_conn->query($histr);
    $row_histr = $histr_task->fetch(PDO::FETCH_ASSOC);
    $idTh = $row_histr['id_task'];
    $departTh = $row_histr['depart_th'];
    $datetimeTh = $row_histr['datetime_th'];
    $statusTh = $row_histr['status_th'];

    $view_dt = "SELECT * FROM department";
    $view_dt = $pdo_conn->query($view_dt);
    while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
    {
    if($row_dt['id_depart']==$departTh) { echo $row_dt['name_depart']; }
    } 
    echo "</a><div align=\"right\"><b>Статус:&nbsp;";

    $view_st = "SELECT * FROM status_tasks";
    $view_st = $pdo_conn->query($view_st);
    while($row_st = $view_st->fetch(PDO::FETCH_ASSOC))
    {
    if($row_st['id_st']==$statusTh) { echo "<font color=\"" . $row_st['color_st']. "\">". $row_st["name_st"]."</font>"; }
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
}else{
  echo "<h2>Нет заданий.</h2>";
}

echo "</center>";

} else {
    echo "<h2 align=\"center\">Вы из какого подразделения?</h2>";
}

?>

</article>
</div> <!-- конец div class="posts-list"-->
</div> <!-- конец div class="container"-->

<?php
include_once "./inc/footer.php"; 

$result = null;
$pdo_conn = null;
?>

</body>
</html>
