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
  <meta name="copyright" content="StaBur CRM">
  <title><? echo "Адаптивная вёрстка CRM от StaBur"; ?></title>
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
      <a title="Логотип" class="logo" href="./"><span>C</span><span>R</span><span>M</span><br /><small>StaBur</small></a>
      <div class="nav-toggle"><span></span></div>
      <form action="./search.php" method="get" id="searchform">
        <input type="text" placeholder="Поиск..." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
      <ul id="menu">
        <li><a href="./tasks.php">Задания</a></li>
        <li><a href="./department.php">Подразделения</a></li>
        <li><a href="./worker.php">Сотрудники</a></li>
      </ul>
    </nav>
  </header>
<?php

$hostname = $_SERVER["REMOTE_ADDR"];
echo $hostname;
if ($hostname=='10.10.10.6'){
  header("Location: ./tasks_view_dep.php?id=6");
}
if ($hostname=='10.10.10.5'){
  header("Location: ./tasks_view_dep.php?id=5");
}
if ($hostname=='10.10.10.4'){
  header("Location: ./tasks_view_dep.php?id=4");
}
function getIpAddress()
{
    $ipAddress = '';
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // to get shared ISP IP address
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) {
            if (! empty($ip)) {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
        $ipAddress = $_SERVER['HTTP_FORWARDED'];
    } else if (! empty($_SERVER['REMOTE_ADDR'])) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }
    return $ipAddress;
}

echo "&nbsp;IP Address: <b>" . getIpAddress() ;
echo "</b>";
?>