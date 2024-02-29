<?php
// Удаляем статус для заданий.
if (isset($redactID)) { 
    echo "<h1 align=\"center\" style=\"color: red\">Вы точно хотите удалить $nameStatusT?</h1><br><center>
    <table border=\"0\">
    <tr><td><form method=\"get\" action=\"\">
    <input type='hidden' name='redactID' value=\"$idStatusT\">
    <input type='hidden' name='delete' value=\"ok\">
    <button class=\"delete\" type=\"submit\" name=\"yes\" value=\"13\">Да</button></form></td>
    <td><form method=\"get\" action=\"./statustasks.php\">
    <button class=\"delete\" type=\"submit\" name=\"redactID\" value=\"$idStatusT\">НЕТ</button>
    </form></td></tr></table>";

if(isset($_GET['yes']) == '13') {
  $query = $pdo_conn->prepare("DELETE FROM status_tasks WHERE `id_st` = :idStatusT");
  $query->bindParam(":idStatusT", $redactID, PDO::PARAM_STR);
  $result = $query->execute();
  if ($result) {
    echo "<h1 align=\"center\" style=\"color: red\">Статус для заданий удаляется!</h1><br><h2><b>Ждите...</b></h2>";
    header("Refresh:1; url=./statustasks.php");
  } else {
    echo '<h1 align=\"center\" style=\"color: red\">Произошла ошибка!</h1>';
  }
}
}

?>