<?php

echo "<h2 align=\"center\">Новый статус для заданий</h2>";

$newStatusT = isset($_POST['newStatusT']) ? $_POST['newStatusT'] : null;

$nameStatusT = isset($_POST['name']) ? $_POST['name'] : null;
$colorStatusT = isset($_POST['color']) ? $_POST['color'] : null;

if(isset($_POST['close'])){
    header("Location: ./statustasks.php");
}

if($newStatusT == 'create'){
  if($nameStatusT) {
  $query = $pdo_conn->prepare("INSERT INTO status_tasks(name_st,color_st) VALUES (:name,:color)");
  $query->bindParam(":name", $nameStatusT, PDO::PARAM_STR);
  $query->bindParam(":color", $colorStatusT, PDO::PARAM_STR);
  $result = $query->execute();
  if ($result) {
      echo "<br><h1 align=\"center\" style=\"color: green\">Новый статус создан!</h1><br><h2 align=\"center\"><b>Ждите...</b></h2>";
      header("Refresh:1; url=./statustasks.php");
  } else {
      echo '<p class="error">Неверные данные!</p>';
  }
}

} else {
    echo "<center><table class=\"widget\" border=\"0\">
            <form method='post' id=\"subscribe\">
            <input type='hidden' name='id' value=\"\">
            <tr><td><p><font color=\"red\">*</font>Наименование статуса:</p></td></tr>
            <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='' required></td></tr>
            <tr><td align=\"center\"><p>Выбирите цвет статуса<br>(по умолчанию черный):</p></td></tr>
            <tr><td align=\"center\">";
            if($colorStatusT){
                echo "<input type=\"color\" name=\"color\" value=\"$colorStatusT\" id=\"colorWell\">";
            } else {
                echo "<input type=\"color\" name=\"color\" value=\"\" id=\"colorWell\">";
            }
            echo "</td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"newStatusT\" value=\"create\">Создать</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr></table></td></tr>
            <tr><td align=\"center\">
            </form></td></tr></table></center>";
}

?>