<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Статусы заданий:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];

 $sql = "SELECT * FROM status_tasks";
 $result = $pdo_conn->query($sql);
 $redactID = intval(isset($_GET['redactID']) ? $_GET['redactID'] : null);
 $newStatusT = isset($_GET['statust']) ? $_GET['statust'] : null;
 
if($redactID){
  $redact = "SELECT * FROM status_tasks WHERE `id_st` = '$redactID'";
  $redact_position = $pdo_conn->query($redact);
  $row_redact = $redact_position->fetch(PDO::FETCH_ASSOC);
  $idStatusT = $row_redact["id_st"];
  $nameStatusT = $row_redact["name_st"];
  $colorStatusT = $row_redact["color_st"];
  
  if(isset($_POST['update']) == $idStatusT){
    include "./inc/edit_statust.php";
}

if(isset($_POST['close'])){
    header("Location: ./statustasks.php");
}

echo "<h1 align=\"center\">Редактирование статуса<br>$nameStatusT</h1>";

if(isset($_POST['delete']) || isset($_GET['delete']) == 'ok'){
    include "./inc/delete_statust.php";
}

echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"$idStatusT\">";
    if(isset($_GET['status']) == 'ok'){
        echo "<tr><td><h1 align=\"center\" style=\"color: green\">Обновлено успешно!</h1></td></tr>";
    }
echo "<tr><td><div align=\"right\"><button class=\"delete\" type=\"submit\" name=\"delete\" value=\"ok\">Удалить</button></div></td></tr>";
echo "<tr><td><p><font color=\"red\">*</font>Наименование статуса:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='$nameStatusT' required></td></tr>
    <tr><td align=\"center\"><p>Выбирите цвет статуса<br>(по умолчанию черный):</p></td></tr>
    <tr><td align=\"center\">";
    if($colorStatusT){
        echo "<input type=\"color\" name=\"color\" value=\"$colorStatusT\" id=\"colorWell\">";
    } else {
        echo "<input type=\"color\" name=\"color\" value=\"\" id=\"colorWell\">";
    }
    echo "</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><button class=\"main\" type=\"submit\" name=\"update\" value=\"$idStatusT\">Сохранить</button>&nbsp;<button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr>
    </form></table></center>";

$row_redact = null; 

} elseif($newStatusT == 'new'){
  include "./inc/new_statust.php";
} else {

if ($result) {
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"statust\" value=\"new\">Создать статус</button></div></form><br>
  <form method='get'><div align=\"center\">";
  // Должности
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<button class=\"main\" title=\"Редактировать\" type=\"submit\" name=\"redactID\" value=\"" . $row["id_st"]. "\">" . $row["name_st"]. "</button><br>";
  }
  echo "</form></div>
  <div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"statust\" value=\"new\">Создать статус</button></div></form><br>";
} else {
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"statust\" value=\"new\">Создать статус</button></div></form><br>";
  echo "<h2 class=\"post-title\">Нет Статусов Заданий</h2>";
}
}

?>
    
<!-- Формат телефонного номера для форм -->
<script type="text/javascript">
    $(".phone").mask("+7(999)999-99-99");
  </script>
<!-- END Формат телефонного номера для форм -->

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