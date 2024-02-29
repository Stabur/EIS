<?php

echo "<h2 align=\"center\">Новая должность</h2>";

$newPosition = isset($_POST['newPosition']) ? $_POST['newPosition'] : null;
$namePosition = isset($_POST['name']) ? $_POST['name'] : null;
$departPosition = isset($_POST['department']) ? $_POST['department'] : null;
$descPosition = isset($_POST['description']) ? $_POST['description'] : null;

if(isset($_POST['close'])){
    header("Location: ./positions.php");
}

  if($newPosition == 'create'){
    if($namePosition) {
    $query = $pdo_conn->prepare("INSERT INTO position_worker(name_position,department_position,description_position) VALUES (:name,:department,:description)");
    $query->bindParam(":name", $namePosition, PDO::PARAM_STR);
    $query->bindParam(":department", $departPosition, PDO::PARAM_STR);
    $query->bindParam(":description", $descPosition, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        echo "<br><h1 align=\"center\" style=\"color: green\">Новая должность создана!</h1><br><h2 align=\"center\"><b>Ждите...</b></h2>";
        header("Refresh:1; url=./positions.php");
    } else {
        echo '<p class="error">Неверные данные!</p>';
    }
  }
} else {
    echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"\">
    <tr><td><p><font color=\"red\">*</font>Наименование должности:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='' required></td></tr>";

    echo "<tr><td><p><font color='red'>*</font>Подразделение/отдел:</p></td></tr>
    <tr><td><select class=\"rounded\" name='department'>";
        
        $redact_dw = "SELECT * FROM department";
        $redact_dw = $pdo_conn->query($redact_dw);
    
        while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
    {
    echo "<option value=\"" . $row_dw["name_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
    }
    echo "</select></td></tr>";
    
    echo "<tr><td><p>Описание:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''></textarea></td></tr>

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"newPosition\" value=\"create\">Создать</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr></table></td></tr>
    <tr><td align=\"center\">
    </form></td></tr></table></center>";
}


?>