<?php
/*
 * Основанием для данного движка послужил
 * форум PostEngine 1.3 (Vladyslav Karpenko <Pirate aka Nervous>)
 * Модифицировали данный скрипт: CallS Group.
 *
*/
$t=microtime(); // засекаем скорость

/* Константы БД */

define ('DBHOST', 'localhost');
define ('DBNAME', 'callscript');
define ('DBUSER', 'root');
define ('DBPASS', '');

/* Подключение к БД */
mysql_pconnect(DBHOST, DBUSER, DBPASS) or die('Соединение отсутсвует!');
mysql_select_db(DBNAME) or die ('Соединение с БД отсутсвует!');
mysql_query('SET NAMES utf8');

/* Мелкие настройки */
ini_set('error_reporting', true); // будем выводить ошибки
ini_set('display_errors', true); // но не будем показывать их пользователю, таким образом ошибки будут логироватся
ini_set('xhtml_errors', true);    // xHTML ошибки тоже важны, поэтому будем их отображать

/* Поиск пользователя в системе */
if(isset($_COOKIE['login'], $_COOKIE['password'])) {
	$query = mysql_query("SELECT * FROM `users` WHERE `login` = '".mysql_real_escape_string($_COOKIE['login'])."' AND `password` = '".mysql_real_escape_string($_COOKIE['password'])."'");
	$user = (mysql_num_rows($query) == 1) ? mysql_fetch_assoc($query) : 0;
} else {
	$user = 0;
}

/* Настройки */
$q = mysql_query("SELECT * FROM `settings`");
while($arr=mysql_fetch_assoc($q)) 
	$set[$arr['id']]=$arr['value'];

/* Определение корня сайта */
define('BASE', '/');

?>