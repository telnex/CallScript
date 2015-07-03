<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ, только зарегистрированным
$total = mysql_result(mysql_query("SELECT count(*) FROM `stat` WHERE `user`='".$user['id']."'"), 0); // Всего звонков
$totaltime = mysql_query("SELECT `start_time`,`stop_time` FROM `stat` WHERE `user`='".$user['id']."'");
while ($row = mysql_fetch_assoc($totaltime)) {
	$time = $row['stop_time'] - $row['start_time'];
	$alltime = $alltime + $time;
}
head('Личный кабинет');
echo '<h1>Личный кабинет</h1>';
echo '<p><strong>';
echo $user['name'];
echo '</strong>';
if ($user['level'] == 3)
	echo ' <span class="label label-info">Администратор</span>';
echo '<br/>';
echo '<small><i>Последний вход: '.clock($user['time']).'.</i></small><br>';
echo 'Количество звонков: '.$total.'.<br>';
echo 'Общее время: '.datediff(0,$alltime).'.</p>';
echo '<table class="table table-bordered table-hover">
        <tr>
			<td><strong>Пользователь</strong></td>
			<td><strong>Длительность звонка</strong></td>
			<td><strong>Дата</td>
		</tr>';
$query = mysql_query("SELECT `start_time`,`stop_time` FROM `stat` WHERE `user`='".$user['id']."' ORDER BY `id` DESC LIMIT ".$page.",".$set['str']);
while ($row = mysql_fetch_assoc($query)) {
	echo '<tr><td>'.$user['login'].'</td><td>'.datediff($row['start_time'],$row['stop_time']).'</td><td>'.clock($row['stop_time']).'</td></tr>';
}
echo '</table>';
if($total > $set['str']) {
	pages($page, $total, 'cab.php?', $set['str']);
}
foot();
?>