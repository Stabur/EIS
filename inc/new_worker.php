<?php

session_start();

echo "<h2 align=\"center\">Новый сотрудник</h2>";

$newWorker = isset($_POST['newWorker']) ? $_POST['newWorker'] : null;

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

if(isset($_POST['close'])){
    header("Location: ./worker.php");
}

if ($newWorker == 'create') {
    if ($nameWorker) {
        $passWorker = password_hash($passWorker, PASSWORD_BCRYPT);

        $query = $pdo_conn->prepare("INSERT INTO worker(surname_worker,name_worker,patronymic_worker,position_worker,department_worker,phone_worker,login_worker,password_worker,pass_nocript_worker,email_worker,messager_worker,description_worker) VALUES (:surname,:name,:patronymic,:position,:department,:phone,:login,:password,:pass_nocript,:email,:messager,:description)");
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
            echo "<br><h1 align=\"center\" style=\"color: green\">Новый сотрудник создан!</h1><h2 align=\"center\"><b>Ждите...</b></h2>";
            header("Refresh:1; url=./worker.php");
        } else {
            echo '<p class="error">Неверные данные!</p>';
        }
    }
} else {
    echo "<center><table class=\"widget\" border=\"0\">
    <form method='post' id=\"subscribe\">
    <input type='hidden' name='id' value=\"\">
    <tr><td><p><font color=\"red\">*</font>Фамилия:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='surname' value='' required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Имя:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='name' value='' required></td></tr>
    <tr><td><p>Отчество:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='patronymic' value=''></td></tr>
    <tr><td><p><font color=\"red\">*</font>Должность:</p></td></tr>
    <tr><td><select class=\"rounded\" name='position'>";

    $redact_pw = "SELECT * FROM position_worker";
    $redact_pw = $pdo_conn->query($redact_pw);

    while($row_pw = $redact_pw->fetch(PDO::FETCH_ASSOC))
{
echo "<option value=\"" . $row_pw["name_position"]. "\">" . $row_pw["name_position"]. "</option>";
}

echo "</select></td></tr>
    <tr><td><p><font color=\"red\">*</font>Подразделения(отдел):</p></td></tr>
    <tr><td><select class=\"rounded\" name='department'>";
    
    $redact_dw = "SELECT * FROM department";
    $redact_dw = $pdo_conn->query($redact_dw);

    while($row_dw = $redact_dw->fetch(PDO::FETCH_ASSOC))
{
echo "<option value=\"" . $row_dw["name_depart"]. "\">" . $row_dw["name_depart"]. "</option>";
}

echo "</select></td></tr>
    <tr><td><p><font color=\"red\">*</font>Телефон:</p></td></tr>
    <tr><td><input class=\"rounded phone\" type='text' inputmode=\"text\" name='phone' value='' required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Логин (только a-z A-Z 0-9):</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='login' value='' pattern=\"[a-zA-Z0-9]+\" required></td></tr>
    <tr><td><p><font color=\"red\">*</font>Пароль:</p></td></tr>
    <tr><td><input class=\"rounded\" type='password' inputmode=\"text\" name='password' value='' required></td></tr>
    <tr><td><p>E-Mail:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='email' value=''></td></tr>
    <tr><td><p>Messager:</p></td></tr>
    <tr><td><input class=\"rounded\" type='text' inputmode=\"text\" name='messager' value=''></td></tr>
    <tr><td><p>Описание:</p></td></tr>
    <tr><td><textarea id=\"area\" name='description' placeholder=''></textarea></td></tr>

    <tr><td>&nbsp;</td></tr>
    <tr><td align=\"center\"><table border=\"0\"><tr><td><button class=\"main\" type=\"submit\" name=\"newWorker\" value=\"create\">Создать</button></form></td><td><form method='post'><button class=\"main\" type=\"submit\" name=\"close\">Отмена</button></td></tr></table></td></tr>
    <tr><td align=\"center\">
    </form></td></tr></table></center>";
}


?>