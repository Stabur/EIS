<?php
// Обновляем данные по Сотруднику.

$idWorker = intval($_POST['idWorker']);

$surnameWorker = isset($_POST['surname']) ? $_POST['surname'] : null;
$nameWorker = isset($_POST['name']) ? $_POST['name'] : null;
$patronymicWorker = isset($_POST['patronymic']) ? $_POST['patronymic'] : null;
$positionWorker = isset($_POST['position']) ? $_POST['position'] : null;
$departWorker = isset($_POST['department']) ? $_POST['department'] : null;
$phoneWorker = isset($_POST['phone']) ? $_POST['phone'] : null;
$loginWorker = isset($_POST['login']) ? $_POST['login'] : null;
$passWorker = isset($_POST['password']) ? $_POST['password'] : null;
$pass_nocriptWorker = isset($_POST['password']) ? $_POST['password'] : null;
$emailWorker = isset($_POST['email']) ? $_POST['email'] : null;
$messagerWorker = isset($_POST['messager']) ? $_POST['messager'] : null;
$descriptWorker = isset($_POST['description']) ? $_POST['description'] : null;

  if ($idWorker) {
      if ($surnameWorker) {
          $passWorker = password_hash($passWorker, PASSWORD_BCRYPT);
  
          $query = $pdo_conn->prepare("UPDATE worker SET surname_worker=:surname,name_worker=:name,patronymic_worker=:patronymic,position_worker=:position,department_worker=:department,phone_worker=:phone,login_worker=:login,password_worker=:password,pass_nocript_worker=:pass_nocript,email_worker=:email,messager_worker=:messager,description_worker=:description WHERE id_worker=:idWorker");
          $query->bindParam("idWorker", $idWorker, PDO::PARAM_STR);
          $query->bindParam("surname", $surnameWorker, PDO::PARAM_STR);
          $query->bindParam("name", $nameWorker, PDO::PARAM_STR);
          $query->bindParam("patronymic", $patronymicWorker, PDO::PARAM_STR);
          $query->bindParam("position", $positionWorker, PDO::PARAM_STR);
          $query->bindParam("department", $departWorker, PDO::PARAM_STR);
          $query->bindParam("phone", $phoneWorker, PDO::PARAM_STR);
          $query->bindParam("login", $loginWorker, PDO::PARAM_STR);
          $query->bindParam("password", $passWorker, PDO::PARAM_STR);
          $query->bindParam("pass_nocript", $pass_nocriptWorker, PDO::PARAM_STR);
          $query->bindParam("email", $emailWorker, PDO::PARAM_STR);
          $query->bindParam("messager", $messagerWorker, PDO::PARAM_STR);
          $query->bindParam("description", $descriptWorker, PDO::PARAM_STR);
          $result = $query->execute();
          if ($result) {
            header("Location: ./worker.php?redactID=$idWorker&status=ok");
          } else {
              echo '<p class="error">Неверные данные!</p>';
          }
      }
  }
?>