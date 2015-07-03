<?php
require_once '../system/core.php';
require_once '../system/functions.php';
only_level(3);
head('Регистрация');
if (isset($_POST['login']) and !empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['password1'])) {
	# Фильтруем все POST данные
	$login = protect($_POST['login']);
	$name = protect($_POST['name']);
	$password = protect($_POST['password']);
	$password1 = protect($_POST['password1']);
	/* Проверка паролей */
	if($password != $password1) {
		echo '<div class="alert alert-error">Пароли не совпадают!</div>
			<a href="/admin/signup.php" class="btn btn-info">Назад</a>';
		foot();
		exit;
	}
	if (mysql_result(mysql_query("SELECT COUNT(*) FROM `users` WHERE `login` = '".$login."' LIMIT 1"),0) != 0) {
		echo '<div class="alert alert-error">Логин уже зарегистрирован!</div>
			<a href="/admin/signup.php" class="btn btn-info">Назад</a>';
		foot($t);
		exit;
	}
	/* Проверка логина на символы */
	if (!preg_match('|^[a-z0-9\-]+$|i',$login)) {
		echo '<div class="alert alert-error">В логине можно использовать только латиницу и цифры!</div>
			<a href="/admin/signup.php" class="btn btn-info">Назад</a>';
		foot($t);
		exit;
	}
	//mysql_query("INSERT INTO `users`(`login`, `password`, `name`, `reg_time`, `time`) VALUES ('".$login."','".md5_sault($password)."','".$name."','".time()."','".time()."')");
	mysql_query("INSERT INTO `users`(`login`, `password`, `name`, `reg_time`, `time`) VALUES ('".$login."','".md5_sault($password)."','".$name."','".time()."','".time()."')");
	mysql_query("INSERT INTO `block`(`user`, `block1`, `block2`, `block3`) VALUES ('".$login."','no','no','no')");
	echo '<div class="alert alert-success">Вы успешно зарегистрировали пользователя!<br/>Логин: '.$login.'<br/>Пароль: '.$password.'</div>
		<a href="/admin/users.php" class="btn btn-info">Назад</a>';
	foot();
	exit;
}
?>
<form action="/admin/signup.php" method="post">
<p>
*Логин: [A-z0-9]<br/>
<input name="login" type="text" value="" /><br/>
*Имя:<br/>
<input name="name" type="text" value="" /><br/>
*Пароль:<br/>
<input name="password" type="text" value="" /><br/>
*Повторите пароль:<br/>
<input name="password1" type="text" value="" /></p><p>
<input type="submit" value="Регистрировать!" class="btn btn-info"/></p></form>
<?php
foot();
?>