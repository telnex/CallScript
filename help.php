<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ, только зарегистрированным
head('Справка');
?>
<h1>Справка</h1>
<h2>Как это работает?</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consectetur, totam porro nemo, iste dolor quae rerum, quasi excepturi earum ratione. Nulla ducimus, rerum minima officiis ipsam blanditiis assumenda odio?</p>
<h2>Кто автор?</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consectetur, totam porro nemo, iste dolor quae rerum, quasi excepturi earum ratione. Nulla ducimus, rerum minima officiis ipsam blanditiis assumenda odio?</p>
<?php
foot($t);
?>