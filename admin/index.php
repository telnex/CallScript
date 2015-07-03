<?php
require_once '../system/core.php'; // стартуем ядро двигателя
require_once '../system/functions.php'; // стартуем функции
only_level(3);
head('Панель управления');
?>
<h1>Панель управления</h1>
<p>
	<a href="users.php">Управление пользователями</a><br/>
	<a href="news.php">Управление уведомлениями</a><br/>
	<a href="#">Статистика системы</a><br/>
	<a href="settings.php">Настройка системы</a>
</p>

<?php
foot($t);
?>