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

mysql_pconnect(DBHOST, DBUSER, DBPASS) or die('Соединение отсутсвует!');
mysql_select_db(DBNAME) or die ('Соединение с БД отсутсвует!');
mysql_query('SET NAMES utf8');

/* Мелкие настройки */
ini_set('error_reporting', true); // будем выводить ошибки
ini_set('display_errors', true); // но не будем показывать их пользователю, таким образом ошибки будут логироватся
ini_set('xhtml_errors', true);    // xHTML ошибки тоже важны, поэтому будем их отображать
$act = isset($_GET['act']) ? $_GET['act'] : ''; // работа со switch
if(isset($_COOKIE['login'], $_COOKIE['password'])) // поиск пользователя в системе
{
	$query = mysql_query("SELECT * FROM `users` WHERE `login` = '".mysql_real_escape_string($_COOKIE['login'])."' AND `password` = '".mysql_real_escape_string($_COOKIE['password'])."'"); // поиск пользователя в системе
	$user = (mysql_num_rows($query) == 1) ? mysql_fetch_assoc($query) : 0;
}
else
{
	$user = 0;
}
/* Настройки */
$q = mysql_query("SELECT * FROM `settings`");
while($arr=mysql_fetch_assoc($q)) $set[$arr['id']]=$arr['value'];

/* Проверка GET данных */
foreach ($_GET as $check_url)
{
    if (is_array($check_url) and !preg_match('#^(?:[a-z0-9_\-/]+|\.+(?!/))*$#i', $check_url))
    {
    	session_start();
        $_SESSION['note'] = 'ERROR 403. Недопустимый запрос!';
        header ("Location: ../404.php");
        exit;
    }
}
unset($check_url);

/* Определение IP-адресса посетителя */
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and preg_match('|^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$|',$_SERVER['HTTP_X_FORWARDED_FOR']))
{
	$ip = trim(htmlspecialchars(mysql_real_escape_string($_SERVER['HTTP_X_FORWARDED_FOR'])));
}
elseif(isset($_SERVER['HTTP_CLIENT_IP']) and preg_match('|^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$|',$_SERVER['HTTP_CLIENT_IP']))
{
	$ip = trim(htmlspecialchars(mysql_real_escape_string($_SERVER['HTTP_CLIENT_IP'])));
}
elseif(isset($_SERVER['REMOTE_ADDR']) and preg_match('|^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$|',$_SERVER['REMOTE_ADDR']))
{
	$ip = trim(htmlspecialchars(mysql_real_escape_string($_SERVER['REMOTE_ADDR'])));
}
else
{
	$ip = 'скрыт';
}
/* Определение UA посетителя */
if (isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']))
{
	$ua = trim(stripcslashes(htmlspecialchars(mysql_real_escape_string($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']))));
}
elseif (isset($_SERVER['HTTP_USER_AGENT']))
{
	$ua = trim(stripcslashes(htmlspecialchars(mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']))));
}
else
{
	$ua = 'скрыт';
}
$ua=strtok($ua, '/');
$ua=strtok($ua, ' ');

/* Работа над Online */
if (!$user)
{
	if (mysql_result(mysql_query("SELECT COUNT(*) FROM `online` WHERE `ip` = '".$ip."' AND `ua` = '".$ua."' AND `time` > '".(time()-300)."'"),0)==1)
	{
  		$onlin=mysql_fetch_array(mysql_query("SELECT * FROM `online` WHERE `ip` = '".$ip."' AND `ua` = '".$ua."' AND `time` > ".(time()-300)));
		mysql_query("UPDATE `online` SET `pereh` = '".($onlin['pereh']+1)."', `time` = '".time()."' WHERE `ip` = '".$ip."' AND `ua` = '".$ua."' LIMIT 1");
	}
	else
	{
		mysql_query("DELETE FROM `online` WHERE `time` < '".(time()-300)."'");
		mysql_query("OPTIMIZE TABLE `online`");
		mysql_query("INSERT INTO `online` (`ip`, `ua`, `time`) values('".$ip."', '".$ua."', ".time().")");
	}
}
else
{
	mysql_query("UPDATE `users` SET `time` = " . time().", `ip` ='".$ip."', `ua`='".$ua."' WHERE `id` = ".$user['id']);
}

/* Определение корня сайта */
for($i=0; $i<60; $i++){
	$p=str_repeat('../', $i);
	if(file_exists($p.'base.level')){
		define('BASE', $p);
		break;
	}
	if($i==59) die('CMS not found!');
}
unset($i, $p);
?>