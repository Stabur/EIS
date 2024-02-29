<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Приоритетные задачи:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];

 $sql = "SELECT * FROM tasks WHERE `priority_task` = 'Yes' ORDER BY `datetime_create_task` DESC";
 $result = $pdo_conn->query($sql);

if ($result) {
  // output data of each row
  echo "<div align=\"center\"><form method=\"get\" action=\"./tasks.php\"><button class=\"main\" type=\"submit\" name=\"task\" value=\"new\">Создать задание</button></form></div></form>";
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<div id=\"" . $row["id_task"]. "\" class=\"block-task\">";
      echo "<div class=\"post-content\">";
      echo "<div class=\"category\"><b>Назначено:</b>&nbsp;" . $row["datetime_create_task"]. "&nbsp;<b>Кому:</b>&nbsp;<a href=\"./tasks.php?viewID=" . $row["id_task"]. "\">";
      $view_dt = "SELECT * FROM department";
      $view_dt = $pdo_conn->query($view_dt);
      while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
      {
      if($row_dt['id_depart']==$row['department_task']) { echo $row_dt['name_depart']; }
      }
      echo "</a></div>";

      echo "<h2 class=\"post-title\"><a href=\"./tasks.php?viewID=" . $row["id_task"]. "\">" . $row["name_task"]. "</a></h2>";
      echo "<p><b>Описание:</b> " . $row["description_task"]. "</p>";
      echo "<div class=\"post-footer\"><a title=\"Просмотреть задание " . $row["name_task"]. "\" class=\"more-link\" href=\"./tasks.php?viewID=" . $row["id_task"]. "\">Просмотреть " . $row["name_task"]. "</a></div></div><br>";
      echo "</div>";
  }
  echo "<div align=\"center\"><form method=\"get\" action=\"./tasks.php\"><button class=\"main\" type=\"submit\" name=\"task\" value=\"new\">Создать задание</button></form></div></form>";
} else {
  echo "<h2 class=\"post-title\">Нет приоритетных заданий</h2>";
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
