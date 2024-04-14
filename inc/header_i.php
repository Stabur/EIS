<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="content-language" content="ru">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="cache-control" content="no-cache">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="0">
  <meta name="author" content="StaBur | https://t.me/StaBur">
  <meta name="reply-to" content="burnov80@gmail.com">
  <meta name="copyright" content="Employee Interaction System">
  <title><? echo "Система Взаимодействия Сотрудников для малого и среднего предприятия"; ?></title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic,700,700italic|Playfair+Display:400,700&subset=latin,cyrillic">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
  <!-- Формат телефонного номера для форм -->
  <script src="./js/jquery-2.2.4.js"></script>
  <script src="./js/jquery.maskedinput.min.js"></script>
  <!-- END Формат телефонного номера для форм -->

</head>
<body>

<header>
    <nav class="container">
      <a title="Логотип" class="logo" href="./"><span>E</span><span>I</span><span>S</span><br /><small>StaBur</small></a>
      <div class="nav-toggle"><span></span></div>
      <form action="./search.php" method="get" id="searchform">
        <input type="text" placeholder="Поиск..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </nav>
  </header>
<?php
/*
$hostname = $_SERVER['SERVER_ADDR'];
echo $hostname;
if ($hostname == '10.10.10.6'){
  header("Location: ./tasks_view_dep.php?id=6");
}
if ($hostname == '10.10.10.5'){
  header("Location: ./tasks_view_dep.php?id=5");
}
if ($hostname == '10.10.10.4'){
  header("Location: ./tasks_view_dep.php?id=4");
}

function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

echo "&nbsp;IP Address: " . get_client_ip_env();

*/
?>