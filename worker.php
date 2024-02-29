<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Сотрудники:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];

 $sql = "SELECT * FROM worker";
 $result = $pdo_conn->query($sql);
 $redactID = intval(isset($_GET['redactID']) ? $_GET['redactID'] : null);
 $newWorker = isset($_GET['worker']) ? $_GET['worker'] : null;
 
 if($redactID){
  $redact = "SELECT * FROM worker WHERE `id_worker` = '$redactID'";
  $redact_worker = $pdo_conn->query($redact);
  $row_redact = $redact_worker->fetch(PDO::FETCH_ASSOC);
  $idWorker = $row_redact["id_worker"];
  $surnameWorker = $row_redact["surname_worker"];
  $nameWorker = $row_redact["name_worker"];
  $patronWorker = $row_redact["patronymic_worker"];
  $positionWorker = $row_redact["position_worker"];
  $departWorker = $row_redact["department_worker"];
  $phoneWorker = $row_redact["phone_worker"];
  $loginWorker = $row_redact["login_worker"];
  $passWorker = $row_redact["pass_nocript_worker"];
  $emailWorker = $row_redact["email_worker"];
  $messagerWorker = $row_redact["messager_worker"];
  $descriptWorker = $row_redact["description_worker"];

  if(isset($_POST['update'])){
    //include "./test2.php";
    include "./inc/edit_worker.php";
}

if(isset($_POST['close'])){
    header("Location: ./worker.php#$redactID");
}

echo "<h1 align=\"center\">Редактирование сотрудника<br>$surnameWorker $nameWorker</h1>";

if(isset($_POST['delete']) || isset($_GET['delete']) == 'ok'){
    include "./inc/delete_worker.php";
}



echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type=\"hidden\" name=\"idWorker\" value=\"$idWorker\">";
    if(isset($_GET['status']) == 'ok'){
        echo "<tr><td><h1 align=\"center\" style=\"color: green\">Обновлено успешно!</h1></td></tr>";
    }
echo "<tr><td><div align=\"right\"><button class=\"delete\" type=\"submit\" name=\"delete\" value=\"ok\">Удалить</button></div></td></tr>";
echo "<tr><td><p><font color=\"red\">*</font>Фамилия:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='surname' value='$surnameWorker' required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Имя:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='$nameWorker' required></td></tr>
    <tr><td><p>Отчество:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='patronymic' value='$patronWorker'></td></tr>
    <tr><td><p><font color=\"red\">*</font>Должность:</p></td></tr>
    <tr><td><select class=\"rounded\" name='position'>";

    $redact_pw = "SELECT * FROM position_worker";
    $redact_pw = $pdo_conn->query($redact_pw);

    while($row_pw = $redact_pw->fetch(PDO::FETCH_ASSOC))
{
echo "<option ";
if($row_pw['name_position']=="$positionWorker") echo "selected=\"selected\"";
echo " value=\"" . $row_pw["name_position"]. "\">" . $row_pw["name_position"]. "</option>";
}

echo "</select></td></tr>
    <tr><td><p><font color=\"red\">*</font>Подразделения(отдел):</p></td></tr>
    <tr><td><select class=\"rounded\" name='department'>";
    
    $redact_dw = "SELECT * FROM department";
    $redact_dw = $pdo_conn->query($redact_dw);

    while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
{
echo "<option ";
if($row_dw['name_depart']=="$departWorker") echo "selected=\"selected\"";
echo " value=\"" . $row_dw["name_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
}

echo "</select></td></tr>
    <tr><td><p><font color=\"red\">*</font>Телефон:</p></td></tr>
    <tr><td><input class=\"rounded phone\" type='text' inputmode=\"text\" name='phone' value='$$phoneWorker' required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Логин (только a-z A-Z 0-9):</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='login' value='$loginWorker' pattern=\"[a-zA-Z0-9]+\" required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Пароль:</p></td></tr>
    <tr><td><input class=\"rounded\" type='password' inputmode=\"text\" name='password' value='$passWorker' required></td></tr>
    <tr><td><p>E-Mail:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='email' value='$emailWorker'></td></tr>
    <tr><td><p>Messager:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='messager' value='$messagerWorker'></td></tr>
    <tr><td><p>Описание:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''>$descriptWorker</textarea></td></tr>

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"update\">Обновить</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Закрыть</button></form></td></tr></table></td></tr></table></center>";

$row_redact = null; 

 } elseif($newWorker == 'new'){
  include "./inc/new_worker.php";
} else{

if ($result) {
  // Список сотрудников
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"worker\" value=\"new\">Создать сотрудника</button></div></form>";
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $idworker = $row["id_worker"];
    $surnameworker = $row["surname_worker"];
    $nameworker = $row["name_worker"];
    $patronworker = $row["patronymic_worker"];
    $positionworker = $row["position_worker"];
    $departworker = $row["department_worker"];

      echo "<div class=\"block-task\">";
      echo "<div id=\"$idworker\" class=\"post-content\">";
      #echo "<div class=\"category\"><a href=\"\">" . $row["name_depart"]. "</a></div>";
      echo "<h2 class=\"post-title\"><a href=\"?redactID=$idworker\">$surnameworker $nameworker $patronworker</a></h2>";
      echo "<p><b>Должность:</b> $positionworker</p><p><b>Подразделение/отдел:</b> $departworker</p>";
      echo "<div class=\"post-footer\"><a title=\"Редактировать $surnameworker $nameworker\" class=\"more-link\" href=\"?redactID=$idworker\">Редактировать $surnameworker $nameworker</a></div></div><br>";
      echo "</div>";
  }
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"worker\" value=\"new\">Создать сотрудника</button></div></form>";
} else {
  echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"worker\" value=\"new\">Создать сотрудника</button></div></form>";
  echo "<h2 class=\"post-title\">Нет Сотрудников</h2>";
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