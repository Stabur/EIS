<?php

echo "<h2 align=\"center\">Новое подразделение</h2>";

$newDepart = isset($_POST['newDepart']) ? $_POST['newDepart'] : null;

$nameDepart = isset($_POST['name']) ? $_POST['name'] : null;
$descDepart = isset($_POST['desc']) ? $_POST['desc'] : null;
$codeDepart = isset($_POST['coded']) ? $_POST['coded'] : null;

if(isset($_POST['close'])){
    header("Location: ./department.php");
}

if($newDepart == 'create'){
  if($nameDepart) {
  $query = $pdo_conn->prepare("INSERT INTO department(name_depart,description_depart,code_depart) VALUES (:name,:descript,:code)");
  $query->bindParam(":name", $nameDepart, PDO::PARAM_STR);
  $query->bindParam(":descript", $descDepart, PDO::PARAM_STR);
  $query->bindParam(":code", $codeDepart, PDO::PARAM_STR);
  $result = $query->execute();
  if ($result) {
      echo "<br><h1 align=\"center\" style=\"color: green\">Новое подразделение создано!</h1><br><h2 align=\"center\"><b>Ждите...</b></h2>";
      header("Refresh:1; url=./department.php");
  } else {
      echo '<p class="error">Неверные данные!</p>';
  }
}

} else {
    echo "<center><table class=\"widget\" border=\"0\">
            <form method='post' id=\"subscribe\">
            <input type='hidden' name='id' value=\"\">
            <tr><td><p><font color=\"red\">*</font>Наименование подразделения:</p></td></tr>
            <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='' required></td></tr>
            <tr><td><p>Описание:</p></td></tr>
            <tr><td><textarea id=\"area\" name='desc' placeholder=''></textarea></td></tr>
            <tr><td><p>Код подразделения:</p></td></tr>
            <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='coded' value=''></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"newDepart\" value=\"create\">Создать</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr></table></td></tr>
            <tr><td align=\"center\">
            </form></td></tr></table></center>";
}


?>