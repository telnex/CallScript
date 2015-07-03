<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ только зарегистрированным
head('Статистика');
$query = mysql_query("SELECT `stat`.*,`users`.`name` FROM `stat` INNER JOIN `users` ON `stat`.`user`=`users`.`id` ORDER BY `id` DESC LIMIT ".$page.",".$set['str']);
$total = mysql_result(mysql_query("SELECT count(*) FROM `stat` ORDER BY `id`"),0); // Всего звонков
echo '<h1>Статистика</h1>
        <div class="tablestat">
            <table class="table table-bordered table-hover">
            	<tr>
					<td><strong>Пользователь</strong></td>
					<td><strong>Длительность звонка</strong></td>
					<td><strong>Дата</strong></td>
				</tr>';
while ($row = mysql_fetch_assoc($query)) {
	echo '<tr><td>'.$row['name'].'</td><td>'.datediff($row['start_time'],$row['stop_time']).'</td><td>'.clock($row['stop_time']).'</td></tr>';
}
echo '</table></div>';
if($total > $set['str']) {
	pages($page, $total, 'stat.php?', $set['str']);
}
if ($user['level'] == 3)
	echo '<a href="/clear.php" class="btn btn-danger">Сбросить всю статистику</a>';
foot();
?>