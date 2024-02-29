<?php
// Удаляем данные по Подразделению.
if (isset($redactID)) { 
    echo "<h1 align=\"center\" style=\"color: red\">Вы точно хотите удалить $nameDepart?</h1><br><center>
    <table border=\"0\">
    <tr><td><form method=\"get\" action=\"\">
    <input type='hidden' name='redactID' value=\"$idDepart\">
    <input type='hidden' name='delete' value=\"ok\">
    <button class=\"delete\" type=\"submit\" name=\"yes\" value=\"13\">Да</button></form></td>
    <td><form method=\"get\" action=\"./department.php\">
    <button class=\"delete\" type=\"submit\" name=\"redactID\" value=\"$idDepart\">НЕТ</button>
    </form></td></tr></table>";

if(isset($_GET['yes']) == '13') {
  $query = $pdo_conn->prepare("DELETE FROM department WHERE `id_depart` = :idDepart");
  $query->bindParam(":idDepart", $redactID, PDO::PARAM_STR);
  $result = $query->execute();
  if ($result) {
    echo "<h1 align=\"center\" style=\"color: red\">Подразделение удаляется!</h1><br><h2><b>Ждите...</b></h2>";
    header("Refresh:1; url=./department.php");
  } else {
    echo '<h1 align=\"center\" style=\"color: red\">Произошла ошибка!</h1>';
  }
}
}

?>