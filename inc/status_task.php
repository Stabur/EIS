<?php
include_once "./inc/func_sess.php";

$idTask = intval(isset($_SESSION['idTask'])) ? $_SESSION['idTask'] : null;
$idDepart = intval(isset($_SESSION['idDepart'])) ? $_SESSION['idDepart'] : null;
$idDepartOut = intval(isset($_SESSION['idDepartOut'])) ? $_SESSION['idDepartOut'] : null;
$datetimeTh = isset($_SESSION['datetime']) ? $_SESSION['datetime'] : null;
$statusTh = intval(isset($_SESSION['status'])) ? $_SESSION['status'] : null;
$idDepartGet = intval(isset($_GET['idDepart']) ? $_GET['idDepart'] : null);
$doneTask = isset($_POST['doneTask']) ? $_POST['doneTask'] : null;
#echo $doneTask;

#echo "$idTask || $idDepart || $idDepartGet || $idDepartOut || $datetimeTh || $statusTh";

if($doneTask=='15'){
    $prov = "SELECT * FROM tasks_history WHERE id_task=$idTask AND depart_th=$idDepart AND status_th='3' ORDER BY `datetime_th` DESC";
    $prov_task = $pdo_conn->query($prov);
    $row_prov = $prov_task->fetch(PDO::FETCH_ASSOC);
    $idPTh = isset($row_prov['id_th']);  

    if($idPTh){
        $datetimePTh = $row_prov['datetime_th'];
        echo "<h1 align=\"center\" style=\"color: green\">Задание уже имеет статус 'Выполненно' для вашего отдела $datetimePTh.</h1>";
    } elseif($idTask) {
    $query = $pdo_conn->prepare("INSERT INTO tasks_history(id_task,depart_th,depart_out_th,datetime_th,status_th) VALUES (:task,:depart,:depart_out,:datetime,:status)");
    $query->bindParam(":task", $idTask, PDO::PARAM_STR);
    $query->bindParam(":depart", $idDepart, PDO::PARAM_STR);
    $query->bindParam(":depart_out", $idDepartOut, PDO::PARAM_STR);
    $query->bindParam(":datetime", $datetimeTh, PDO::PARAM_STR);
    $query->bindParam(":status", $statusTh, PDO::PARAM_STR);
    $result = $query->execute();
    if ($result) {
        echo "<br><h1 align=\"center\" style=\"color: green\">Выполненно!</h1>";
        #header("Refresh:1; url=./tasks_view_dep.php?viewID=$idTask");
    } else {
        echo '<p class="error">Неверные данные!</p>';
    }
}
}

if($idDepartGet){

$prov2 = "SELECT * FROM tasks_history WHERE id_task=$idTask AND depart_th=$idDepartGet ORDER BY `datetime_th` DESC";
$prov_task2 = $pdo_conn->query($prov2);
$row_prov2 = $prov_task2->fetch(PDO::FETCH_ASSOC);
$idPTh2 = isset($row_prov2['id_th']);  
        
$depart = "SELECT * FROM department WHERE id_depart=$idDepartGet";
$depart = $pdo_conn->query($depart);
$row_depart = $depart->fetch(PDO::FETCH_ASSOC);
$nameDepart = $row_depart['name_depart'];

    if($idPTh2){
        $datetimePTh = $row_prov2['datetime_th'];
        echo "<h1 align=\"center\" style=\"color: green\">Это задание уже назначено подразделению $nameDepart - $datetimePTh.</h1>";
    } elseif($idTask) {
        $statusTh='1';
    $query = $pdo_conn->prepare("INSERT INTO tasks_history(id_task,depart_th,depart_out_th,datetime_th,status_th) VALUES (:task,:depart,:depart_out,:datetime,:status)");
    $query->bindParam(":task", $idTask, PDO::PARAM_STR);
    $query->bindParam(":depart", $idDepartGet, PDO::PARAM_STR);
    $query->bindParam(":depart_out", $idDepartOut, PDO::PARAM_STR);
    $query->bindParam(":datetime", $datetimeTh, PDO::PARAM_STR);
    $query->bindParam(":status", $statusTh, PDO::PARAM_STR);
    $result = $query->execute();

    $query2 = $pdo_conn->prepare("UPDATE tasks SET department_task=:department WHERE id_task=:idTask");
    $query2->bindParam(":idTask", $idTask, PDO::PARAM_STR);
    $query2->bindParam(":department", $idDepartGet, PDO::PARAM_STR);
    $result2 = $query2->execute();

    if ($result && $result2) {
        echo "<br><h1 align=\"center\" style=\"color: green\">Задание передано подразделению $nameDepart!</h1>";
        header("Refresh:2; url=./tasks_view_dep.php?id=$idDepart");
    } else {
        echo '<p class="error">Неверные данные!</p>';
    }
}
}

?>