
<?php
function Calendar()
 
{
    if(isset($_GET['date'])){
        $dayChange=$_GET['date'];
    }
    else{
    $dayChange = date('j');
     }
      if(isset($_GET['month'])){
        $monthChange=$_GET['month'];
    }
        else{
        $monthChange = date('n');
         }
    if(isset($_GET['month'])){
        $yearChange=$_GET['year'];
    }
        else{
        $yearChange = date('Y');
         }
   
   
  $dayofmonth = date('t');
  $day_count = 1;
  $num = 0;
  for($i = 0; $i < 7; $i++)
  {
    $dayofweek = date('w', mktime(0, 0, 0, date('m'), $day_count, date('Y')));
    $dayofweek = $dayofweek - 1;
    if($dayofweek == -1) $dayofweek = 6;
    if($dayofweek == $i)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
    }
    else
    {
      $week[$num][$i] = "";
    }
  }
  while(true)
  {
    $num++;
    for($i = 0; $i < 7; $i++)
    {
      $week[$num][$i] = $day_count;
      $day_count++;
      if($day_count > $dayofmonth) break;
    }
    if($day_count > $dayofmonth) break;
  }
  switch (date("m"))
  {
    case 1:
        $name_of_month = "Январь";
        break;
    case 2:
        $name_of_month = "Февраль";
        break;
    case 3:
        $name_of_month = "Март";
        break;
    case 4:
        $name_of_month = "Апрель";
        break;
    case 5:
        $name_of_month = "Май";
        break;
    case 6:
        $name_of_month = "Июнь";
        break;
    case 7:
        $name_of_month = "Июль";
        break;
    case 8:
        $name_of_month = "Август";
        break;
    case 9:
        $name_of_month = "Сентябрь";
        break;
    case 10:
        $name_of_month = "Октябрь";
        break;
    case 11:
        $name_of_month = "Ноябрь";
        break;
    case 12:
        $name_of_month = "Декабрь";
        break;
    }
  echo "<font size=6><b><i><div align=\"center\">"
      .$name_of_month." ".date('Y').
      "</div></i></b></font><table border=0 width=250>";
  $name_of_days[] = "Пн.";
  $name_of_days[] = "Вт.";
  $name_of_days[] = "Ср.";
  $name_of_days[] = "Чт.";
  $name_of_days[] = "Пт.";
  $name_of_days[] = "Сб.";
  $name_of_days[] = "Вс.";
  for ($i = 0; $i < 7; $i++)
  {
      $name_of_days[$i] = $name_of_days[$i];
    $name_of_day = $name_of_days[$i];
    if ($i < 5) echo "<td><font aling=\"right\"></div>$name_of_day</font></td>";
    else echo "<td><b>$name_of_day</b></td>";
  }
  echo "</tr>";
  for($i = 0; $i < count($week); $i++)
  {
 
    echo "<tr  onclick=\"document.location = 'form_add_post.inc.php';\">";
    for($j = 0; $j < 7; $j++)
    {
      if(!empty($week[$i][$j]))
      {
        $day = mktime(0, 0, 0, date("m"), $week[$i][$j],   date("Y"));
        $now = mktime(0, 0, 0, date("m"), date("d"),   date("Y"));
        $color_of_day="#000000";
        $p1 = ""; $p2 = "";
        if($day == $now)
        {
            $color_of_day="#FF0000";
            $p1 = "<b>"; $p2 = "</b>";
        }
        $datechange='month='.$monthChange.'&day='.$dayChange.'&year='.$yearChange;
      $line = "<td class='color_tr'><font color=$color_of_day>"."<a href='add_post.inc.php?.$datechange'>"."<div align=\"center\">";
        if($j == 5 || $j == 6)
             $line = $line."<b>".$week[$i][$j]."</b>";
        else $line = $line.$p1.$week[$i][$j].$p2;
        echo $line."</color></div></td>";
 
      }
      else echo "<td class='space_color'>&nbsp;</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
}
 
 
?>
