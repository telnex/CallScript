<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ только зарегистрированным
head('Рейтинг');
$query = mysql_query("SELECT `stat`.*,`users`.`name` FROM `stat` INNER JOIN `users` ON `stat`.`user`=`users`.`id` ORDER BY `id` DESC LIMIT 30");
while ($row = mysql_fetch_assoc($query)) {
	$difftime = $row['stop_time']-$row['start_time'];
	$meant[] = array(
			"id" => $row['user'],
			"name" => $row['name'],
			"time" => $difftime
			);
	$name[] = $row['name'];
}
array_unique($name); // Удаляем повторяющиеся элементы массива
foreach ($name as $value) {
	$alltime = 0;
	$count = 0;
	for($i=0; $i<count($meant); $i++) {
		if ($value == $meant[$i]['name']) {
			$alltime = $alltime + $meant[$i]['time'];
			$count++;			
		}
	}
	$index = $count * $alltime;
	$criter[$value] = $index;
}
arsort($criter); // Сортируем массив по убыванию
echo $sortby;
echo '<h1>Рейтинг</h1>
		<div class="tablestat">
            <table class="table table-bordered table-hover">
            	<tr>
            		<td><strong>Место</strong></td>
					<td><strong>Пользователь</strong></td>
					<td><strong>КПД</strong></td>
				</tr>';
$i=0;
foreach ($criter as $key => $value) {
	echo '<tr><td>'.++$i.'</td><td>'.$key.'</td><td>'.$value.'</td></tr>';
}
echo '</table>
<small>КПД определяется как кол-во звонков * среднее время звонка.<br/>Для того, чтобы сбросить рейтинг, необходимо очистить всю статистику (функция доступна только администраторам).</small>
</div>';
echo '<a href="/stat.php" class="btn btn-info">Перейти в статистику</a>';
if ($user['level'] == 3)
	echo ' <a href="/clear.php" class="btn btn-danger">Сбросить всю статистику</a>';
foot();
?>