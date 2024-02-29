<?php
// Создаем соединение с базой данных
define('USER', 'stabur');
define('PASSWORD', 'qWest11061980');
define('HOST', '192.168.1.238');
define('DATABASE', 'stabur_crm');
try {
    $pdo_conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("<center><font color=red><b>Error:</b> " . $e->getMessage()."</font></center>");
    die();
}

/* Host name of the MySQL server. */
//$host = 'localhost';
/* MySQL account username. */
//$user = 'myUser';
/* MySQL account password. */
//$passwd = 'myPasswd';
/* The default schema you want to use. */
//$schema = 'mySchema';
/* The PDO object. */
//$pdo = NULL;
/* Connection string, or "data source name". */
//$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;
//try
//{  
   /* PDO object creation. */
//   $pdo = new PDO($dsn, $user,  $passwd);
   
   /* Enable exceptions on errors. */
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
//catch (PDOException $e)
//{
   /* If there is an error, an exception is thrown. */
//   echo 'Database connection failed.';
//   die();
//}

?>