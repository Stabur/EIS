<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Должности:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];

 $sql = "SELECT * FROM position_worker";
 $result = $pdo_conn->query($sql);
 $redactID = intval(isset($_GET['redactID']) ? $_GET['redactID'] : null);
 $newPosition = isset($_GET['position']) ? $_GET['position'] : null;
 
if($redactID){
  $redact = "SELECT * FROM position_worker WHERE `id_position` = '$redactID'";
  $redact_position = $pdo_conn->query($redact);
  $row_redact = $redact_position->fetch(PDO::FETCH_ASSOC);
  $idPosition = $row_redact["id_position"];
  $namePosition = $row_redact["name_position"];
  $departPosition = $row_redact["department_position"];
  $descriptPosition = $row_redact["description_position"];
  
  if(isset($_POST['update'])){
    include "./inc/edit_position.php";
}

if(isset($_POST['close'])){
    header("Location: ./positions.php#$idPosition");
}

echo "<h1 align=\"center\">Редактирование должности<br>$namePosition</h1>";

if(isset($_POST['delete']) || isset($_GET['delete']) == 'ok'){
    include "./inc/delete_position.php";
}

echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"$idPosition\">";
    if(isset($_GET['status']) == 'ok'){
        echo "<tr><td><h1 align=\"center\" style=\"color: green\">Обновлено успешно!</h1></td></tr>";
    }
echo "<tr><td><div align=\"right\"><button class=\"delete\" type=\"submit\" name=\"delete\" value=\"ok\">Удалить</button></div></td></tr>";
echo "<tr><td><p><font color=\"red\">*</font>Наименование должности:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='$namePosition' required></td></tr>";

    echo "<tr><td><p><font color='red'>*</font>Подразделение/отдел:</p></td></tr>
    <tr><td><select class=\"rounded\" name='department'>";
    
        $redact_dw = "SELECT * FROM department";
        $redact_dw = $pdo_conn->query($redact_dw);
    
        while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
    {
    echo "<option ";
    if($row_dw['name_depart']=="$departPosition") echo "selected=\"selected\"";
    echo " class=\"rounded\" value=\"" . $row_dw["name_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
    }
    
echo "<tr><td><p>Описание:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''>$descriptPosition</textarea></td></tr>

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><button class=\"main\" type=\"submit\" name=\"update\">Сохранить</button>&nbsp;<button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr>
    <tr><td align=\"center\">
    </form></td></tr></table></center>";

$row_redact = null; 

} elseif($newPosition == 'new'){
  include "./inc/new_position.php";
} else {

if ($result) {
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"position\" value=\"new\">Создать должность</button></div></form><br>";
  // Должности
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<div class=\"block-task\">";
      echo "<div id=\"" . $row["id_position"]. "\" class=\"post-content\">";
      #echo "<div class=\"category\"><a href=\"\">" . $row["name_depart"]. "</a></div>";
      echo "<h2 class=\"post-title\"><a href=\"?redactID=" . $row["id_position"]. "\">" . $row["name_position"]. "</a></h2>";
      echo "<p> <b>Подразделение:</b> "  . $row["department_position"]. "</p>";
      echo "<div class=\"post-footer\"><a title=\"Редактировать " . $row["name_position"]. "\" class=\"more-link\" href=\"?redactID=" . $row["id_position"]. "\">Редактировать " . $row["name_position"]. "</a></div></div><br>";
      echo "</div>";
  }
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"position\" value=\"new\">Создать должность</button></div></form><br>";
} else {
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"position\" value=\"new\">Создать должность</button></div></form><br>";
  echo "<h2 class=\"post-title\">Нет должностей</h2>";
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