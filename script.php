<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg();
head('Скрипты');
echo '<h1>Доступные скрипты</h1>';
echo '<p><a href="/newcall.php">Приглашение на МК</a></p>';
foot();
exit;
?>