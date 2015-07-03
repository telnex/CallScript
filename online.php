<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg();
head('Онлайн');
switch($act)
{
	default:
 	$users = mysql_query("SELECT * FROM `users` WHERE `time` > '".(time()-300)."' order by `id` limit ".$page.",".$set['str']."");
 	$total = mysql_result(mysql_query("SELECT count(*) FROM `users` WHERE `time` > '".(time()-300)."'"),0);
  echo '<h1>Пользователи онлайн</h1>';
 	echo '<p>Зарегистрированых пользователей в онлайне: '.$total.'</p>';
 	if($total > 0)
 	{
      echo '<table class="table table-bordered table-hover">
              <tr>
                <td><strong>Пользователь</strong></td>
                <td><strong>Местонахождение</strong></td>
                <td><strong>Последний вход</strong></td>
              </tr>';
  		while($row = mysql_fetch_assoc($users))
  		{
   			echo '<tr><td>'.$row['name'].' '.status($row['id']).'</td><td>'.$row['where'].'</td><td>'.clock($row['time']).'</td></tr>';
  		}
      echo '</table>';
 	}
 	else
 	{
  		echo '<div class="error">Пользователей онлайн нет!</div>';
 	}
 	echo '<div class="navigation">
 	</div>';
 	if($total > $set['str'])
 	{
   		pages($page, $total, 'online.php?', $set['str']);
 	}
	break;
}
foot($t);
?>
