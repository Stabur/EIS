<!DOCTYPE html>
<html>

<?php
include_once "./inc/connectBD.php";
include_once "./inc/header.php"; 

$search = isset($_GET['search']) ? $_GET['search'] : null;

?>

  <div class="container">
  <div class="posts-list">
    <article class="post">

<?php
 $url = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];
  
 $datetime = date('Y-m-d H:i:s');

if($search){
    echo "<h2 class=\"post-title\" align=\"center\">Поиск $search:</h2>";

    $sql = "SELECT * FROM `tasks` LIKE ?";
    $stmt = $pdo_conn->prepare($sql);
    $stmt->bindValue(1, "%$search%",PDO::PARAM_STR);
    $stmt->execute();
    $done = $stmt->fetch();

    var_dump($done[0]);
    echo $stmt;

} else {
    echo "<h2 class=\"post-title\" align=\"center\">Не заполнено поле поиска!</h2>";
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
