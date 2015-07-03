<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ только зарегистрированным
head('Новый звонок');
if(isset($_GET['stopcall'])) {
	$stoptime = mysql_fetch_assoc(mysql_query("SELECT `stop_time` FROM `stat` WHERE `user` = '".$user['id']."' ORDER BY `id` DESC LIMIT 1;"));
	if ($stoptime['stop_time']==0) {
		mysql_query("UPDATE `stat` SET `stop_time`= '".time()."' WHERE `user` = '".$user['id']."' ORDER BY `id` DESC LIMIT 1;");
	}
}
$query = mysql_query("SELECT `start_time`,`stop_time` FROM `stat` WHERE `user`='".$user['id']."' ORDER BY `id` ASC");
$call = 0;
while ($row = mysql_fetch_assoc($query)) {
	$time = $row['stop_time'] - $row['start_time'];
	$alltime = $alltime + $time;
	$call++;
}
$diff = datediff(0,$time); // Длительность последнего звонка
echo '<h1>Новый звонок</h1>';
echo '<p>Длительность последнего звонка: '.$diff.'<br/>';
echo 'Количество звонков: '.$call.'.<br/>';
echo 'Общее время: '.datediff(0,$alltime).'.</p>';
echo '<a class="btn btn-info btn-large" href="/invitemk.php?newcall">Новый звонок</a>';
foot();
?>