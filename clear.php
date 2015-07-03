<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ только зарегистрированным
if ($user['level']>=3) {
	head('Главная');
	switch ($act) {
		case 'yes':
			mysql_query('DELETE FROM `stat`');
			echo '<h1>Сброс статистики</h1>';
			echo '<p>OK, Статистика сброшена.</p>';
			break;
		
		default:
			echo '<h1>Сброс статистики</h1>';
			echo '<p>Вы действительно хотите сбросить всю статистику?<br/><small>Данный процесс необратим!</small></p>';
			echo '<a href="?act=yes" class="btn btn-danger">Стереть</a> <a href="/stat.php" class="btn btn-info">Отменить</a>';
			break;
	}
	foot();
}