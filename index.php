<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">
    <h2 class="post-title" align="center">Предварительный просмотр как:</h2>

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];
  
 $datetime = date('Y-m-d H:i:s');

 $viewID = intval(isset($_GET['viewID']) ? $_GET['viewID'] : null);

 if($viewID){
  
  header("Location: ./tasks_view_dep.php?id=$viewID");

 } else {

 $sql = "SELECT * FROM department";
 $result = $pdo_conn->query($sql);

if ($result) {
  // output data of each row
  echo "<form method='get'><div align=\"center\">";
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo "<button class=\"main\" title=\"Просмотреть как будет видеть " . $row["name_depart"]. "\" type=\"submit\" name=\"viewID\" value=\"" . $row["id_depart"]. "\">" . $row["name_depart"]. "</button><br>";
    }
    echo "</div></form>";
} else {
  echo "<h2 class=\"post-title\">Что-то пошло не так...</h2>";
}
 }


?>

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
