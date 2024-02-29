<?php
# Подсчитываем количество записей в таблицах
# Кол-во Заданий:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM tasks WHERE status_task!='4'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_tasks=$query->fetch();
$count_tasks=$row_tasks['count'];
# Кол-во Заданий в приоретете:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM tasks WHERE priority_task='Yes'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_tasks_prior=$query->fetch();
$count_tasks_prior=$row_tasks_prior['count'];
# Кол-во Заданий в архиве:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM tasks WHERE status_task='4'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_tasks_arch=$query->fetch();
$count_tasks_arch=$row_tasks_arch['count'];
# Кол-во Сотрудников:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM worker");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_worker=$query->fetch();
$count_worker=$row_worker['count'];
# Кол-во Подразделений:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM department");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_depart=$query->fetch();
$count_depart=$row_depart['count'];
# Кол-во Должностей:
$query=$pdo_conn->query("SELECT COUNT(*) as count FROM position_worker");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row_position=$query->fetch();
$count_position=$row_position['count'];

# Вывод последних 3-х Заданий:
$task_recent = $pdo_conn->query("SELECT * FROM tasks ORDER BY id_task DESC LIMIT 3");

?>
  <aside>
  <div class="widget">
    <h3 class="widget-title">Категории</h3>
    <ul class="widget-category-list">
      <li><a href="./tasks_priority.php">Приоритетные задания</a> (<?php echo "$count_tasks_prior"; ?>)</li>
      <li><a href="./tasks.php">Задания</a> (<?php echo "$count_tasks"; ?>)</li>
      <li><a href="./worker.php">Сотрудники</a> (<?php echo "$count_worker"; ?>)</li>
      <li><a href="./department.php">Подразделения/отделы</a> (<?php echo "$count_depart"; ?>)</li>
      <li><a href="./positions.php">Должности</a> (<?php echo "$count_position"; ?>)</li>
      <!--<li><a href="./statustasks.php">Статусы заданий</a></li>-->
      <li><a href="./archive.php">Архив заданий</a> (<?php echo "$count_tasks_arch"; ?>)</li>
    </ul>
  </div>
  <div class="widget">
    <h3 class="widget-title">Новые задачи</h3>
    <ul class="widget-posts-list">

      <li>
      <? foreach ($task_recent as $row): ?>
        <div class="post-image-small"><?=$row['datetime_create_task']?></div>
        <h4 class="widget-post-title">&nbsp;<a href="tasks.php#<?=$row['id_task']?>"><b>Назначено:&nbsp;
          <?
          $view_dt = "SELECT * FROM department";
          $view_dt = $pdo_conn->query($view_dt);
          while($row_dt = $view_dt->fetch(PDO::FETCH_ASSOC))
          {
          if($row_dt['id_depart']==$row['department_task']) { echo $row_dt['name_depart']; }
          } 
          ?>
          </b><br /><b><?=$row['name_task']?></b><br /><?=$row['description_task']?></a><br /><br /></h3>
      <? endforeach ?>
      </li>

    </ul>
  </div>
  <div class="widget">
    <h3 class="widget-title">Подписка на рассылку</h3>
    <form action="" method="post" id="subscribe">
      <input type="telegram" name="messager" placeholder="Telegram или WhatsApp" required>
      <button type="submit"><i class="fa fa-paper-plane-o"></i></button>
    </form>
  </div>
</aside>