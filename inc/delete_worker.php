<?php
// Удаляем данные по Сотруднику.
if ($redactID && $idWorker && $surnameWorker) { 
    echo "<h1 align=\"center\" style=\"color: red\">Вы точно хотите удалить $surnameWorker $nameWorker?</h1><br><center>
    <table border=\"0\">
    <tr><td><form method=\"get\" action=\"\">
    <input type='hidden' name='redactID' value=\"$idWorker\">
    <input type='hidden' name='delete' value=\"ok\">
    <button class=\"delete\" type=\"submit\" name=\"yes\" value=\"13\">Да</button></form></td>
    <td><form method=\"get\" action=\"./worker.php\">
    <button class=\"delete\" type=\"submit\" name=\"redactID\" value=\"$idWorker\">НЕТ</button>
    </form></td></tr></table>";

    if(isset($_GET['yes']) == '13') {
      $query = $pdo_conn->prepare("DELETE FROM worker WHERE `id_worker` = :idWorker");
      $query->bindParam(":idWorker", $idWorker, PDO::PARAM_STR);
      $result = $query->execute();
      if ($result) {
        echo "<h1 align=\"center\" style=\"color: red\">Сотрудник удаляется!</h1><br><h2><b>Ждите...</b></h2>";
        header("Refresh:1; url=./worker.php");
      } else {
        echo '<h1 align=\"center\" style=\"color: red\">Произошла ошибка!</h1>';
      }
    }
    }



?>