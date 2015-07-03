<?php
require_once 'system/core.php';
require_once 'system/functions.php';
reg();
head('404');
echo '<h1>ОШИБКА 404: страница не найдена </h1>';
echo '<a href="/index.php">На главную</a>';
foot($t);
exit;
?>