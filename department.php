<!DOCTYPE html>
<html>

<? 
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 
?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Подразделения:</h2>

    <?php
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $url = $url[0];

    $sql = "SELECT * FROM department";
    $result = $pdo_conn->query($sql);
    $redactID = intval(isset($_GET['redactID'])) ? $_GET['redactID'] : null;
    $newDep = isset($_GET['depart']) ? $_GET['depart'] : null;

    
    if($redactID){
        $redact = "SELECT * FROM department WHERE `id_depart` = '$redactID'";
        $redact_depart = $pdo_conn->query($redact);
        $row_redact = $redact_depart->fetch(PDO::FETCH_ASSOC);
        $idDepart = $row_redact["id_depart"];
        $nameDepart = $row_redact["name_depart"];
        $descDepart = $row_redact["description_depart"];
        $codeDepart = $row_redact["code_depart"];

        if(isset($_POST['update'])){
            include "./inc/edit_depart.php";
        }

        if(isset($_POST['close'])){
            header("Location: ./department.php#$idDepart");
        }

        echo "<h1 align=\"center\">Редактирование подразделения $nameDepart</h1>";

        if(isset($_POST['delete']) || isset($_GET['delete']) == 'ok'){
            include "./inc/delete_depart.php";
        }

        echo "<center><table class=\"widget\" border=\"0\">
            <form method='post' id=\"subscribe\">
            <input type='hidden' name='id' value=\"$idDepart\">";
            if(isset($_GET['status']) == 'ok'){
                echo "<tr><td><h1 align=\"center\" style=\"color: green\">Обновлено успешно!</h1></td></tr>";
            }
        echo "<tr><td><div align=\"right\"><button class=\"delete\" type=\"submit\" name=\"delete\" value=\"ok\">Удалить</button></div></td></tr>";
        echo "<tr><td><p><font color=\"red\">*</font>Наименование подразделения:</p></td></tr>";
        echo "<tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='$nameDepart' required></td></tr>
            <tr><td><p>Описание:</p></td></tr>
            <tr><td><textarea id=\"area\" name='desc' placeholder=''>$descDepart</textarea></td></tr>
            <tr><td><p>Код подразделения:</p></td></tr>
            <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='coded' value='$codeDepart'></td></tr>
            <tr><td>&nbsp;</td></tr>
            <tr><td align=\"center\"><button class=\"main\" type=\"submit\" name=\"update\">Сохранить</button>&nbsp;<button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr>
            <tr><td align=\"center\">
            </form></td></tr></table></center>";
               
    
    } elseif($newDep == 'new'){
        include "./inc/new_depart.php";
    } else {

    if ($result) {
        echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"depart\" value=\"new\">Создать подразделение</button></div></form>";
        // output data of each row
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class=\"block-task\">";
            echo "<div id=\"" . $row["id_depart"]. "\" class=\"post-content\">";
            #echo "<div class=\"category\"><a href=\"\">" . $row["name_depart"]. "</a></div>";
            echo "<h2 class=\"post-title\"><a href=\"?redactID=" . $row["id_depart"]. "\">" . $row["name_depart"]. "</a></h2>";
            echo "<p>" . $row["description_depart"]. "</p>";
            echo "<div class=\"post-footer\"><a title=\"Редактировать " . $row["name_depart"]. "\" class=\"more-link\" href=\"?redactID=" . $row["id_depart"]. "\">Редактировать " . $row["name_depart"]. "</a></div></div><br>";
            echo "</div>";
        }
        echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"depart\" value=\"new\">Создать подразделение</button></div></form>";
    } else {
        echo "<div align=\"center\"><form method=\"get\"><button class=\"main\" type=\"submit\" name=\"depart\" value=\"new\">Создать подразделение</button></div></form><br>
        <h2 class=\"post-title\">Нет подразделений</h2>";
    }
}


    ?>

    </article>
  </div> <!-- конец div class="posts-list"-->

<? include_once "./inc/right_block.php"; ?>
</div> <!-- конец div class="container"-->

<? 
include_once "./inc/footer.php"; 
$result = null;
$pdo_conn = null;
?>

</body>
</html>