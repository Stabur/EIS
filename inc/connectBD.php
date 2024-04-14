<?php
// Создаем соединение с базой данных
define('USER', 'root');
define('PASSWORD', 'password');
define('HOST', 'localhost');
define('DATABASE', 'eis');
try {
    $pdo_conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("<center><font color=red><b>Error:</b> " . $e->getMessage()."</font></center>");
    die();
}

?>