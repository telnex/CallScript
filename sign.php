<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
unreg();
if(isset($_GET['exit'])) {
	setcookie('login', '', time()-1, '/');
	setcookie('password', '', time()-1, '/');
	session_destroy();
	header("Location: ./sign.php");
	exit;
}
if(isset($_GET) and !empty($_GET['login']) and !empty($_GET['password'])) {
	$login = protect($_GET['login'], 12);
	$password = protect(md5_sault($_GET['password']));
	$check = mysql_result(mysql_query("SELECT count(*) FROM `users` WHERE `login` = '".$login."' and `password` = '".$password."'"),0);
	if($check == 0)	{
		head('Авторизация');
		echo '<h1>Авторизация</h1>';
		echo '<div class="alert alert-error">Неверный логин и/или пароль!</div>';
		echo '<p><a href="/sign.php" class="btn btn-success">Повтроить ввод</a></p>';
		foot($t);
		exit;
	}
	else {
		setcookie('login', $login, time()+3600*24*365, '/');
		setcookie('password', $password, time()+3600*24*365, '/');
		mysql_query("DELETE FROM `online` WHERE `ip` = '".$ip."' AND `ua` = '".$ua."' LIMIT 1");
		header("Location: ./index.php");
		exit;
	}
}
head('Авторизация');
?>
<h1>Авторизация</h1>
<form action="sign.php" method="get">
	<p>Ваш логин:<br/>
	<input name="login" type="text" required/><br />
	Ваш пароль:<br/>
	<input name="password" type="password" required/><br />
	</p>
	<input class="btn btn-success" type="submit" value="Войти" class="btn btn-success"/>
</form>
<?php
foot($t);
?>