<?php
require_once '../system/core.php'; // стартуем ядро двигателя
require_once '../system/functions.php'; // стартуем функции
only_level(3);
head('Панель управления > Пользователи');
switch($act)
{
    default:
    echo '<h1>Пользователи</h1>';
    $query = mysql_query("SELECT `id`,`login` FROM `users` order by `id` limit ".$page.",".$set['str']."");
    $total = mysql_result(mysql_query("SELECT count(*) FROM `users`"),0);
    echo '<table class="table">';
	echo '<tr><td><strong>Логин</strong></td><td><strong>Действие</strong></td></tr>';
	while ($row = mysql_fetch_assoc($query))
	{
 		$i++;
		echo '<tr><td>'.$row['login'];
  		echo status($row['id']).'</td><td>
  		<a href="users.php?act=edit&amp;login='.$row['login'].'">[ред]</a> | <a href="users.php?act=delete&amp;id='.$row['id'].'">[удл]</a></td></tr>';
	}
	echo '</table>';
    if($total > $set['str'])
    {
		pages($page, $total, 'users.php?', $set['str']);
  	}
    break;
    case 'edit':
    $us = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `login` = '".protect($_GET['login'])."'"));
    if(!$us)
    {
    	echo '<div class="alert alert-error">Пользователь не найден!</div>';
    	foot($t);
    	exit;
    }
    if(isset($_POST['name']) and !empty($_POST['name']))
	{
 		mysql_query("UPDATE `users` SET
		name='".protect($_POST['name'])."',
		mail='".protect($_POST['mail'])."',
  		level='".int($_POST['level'])."'
		WHERE `id`=".$us['id']);
		if(isset($_POST['password']) and !empty($_POST['password']))
		{
			mysql_query("UPDATE `users` SET password='".md5_sault(protect($_POST['password']))."' WHERE `id`=".$us['id']);
		}
  		echo '<div class="alert alert-success">Данные о пользователе '.$us['login'].' успешно изменены!</div>';
		foot($t);
		exit;
	}
	echo '<h1>Редактирование пользователя</h1>';
	echo '<form action="users.php?act=edit&amp;login='.$us['login'].'" method="post"><p>
	Имя:<br/>
	<input name="name" type="text" value="'.$us['name'].'"/><br/>
 	Должность:<br/>
 	<select size="1" name="level">
 	<option value="1">Пользователь</option>
 	<option value="3">Администратор</option>
 	</select><br/>';
	echo 'E-mail:<br/>
	<input name="mail" type="text" value="'.$us['mail'].'"/><br/>
	Пароль: <small>(если не нужно изменять, оставить пустым)</small><br/>
	<input name="password" type="text" /><br/></p><p>
	<input type="submit" value="Изменить" class="btn btn-success"/>
	</p></form>';
    break;
    case 'delete':
    $us = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = ".int($_GET['id'])));
    if(!$us)
    {
    	echo '<div class="alert alert-error">Пользователь не найден!</div>';
    	foot($t);
    	exit;
    }
    if(isset($_GET['do']))
    {
    	if(isset($_POST['1']))
    	{
    		mysql_query("delete FROM `users` WHERE `id` = ".$us['id']."");
    		echo '<div class="alert alert-success">Пользователь успешно удален!</div>';
    		foot($t);
    		exit;
    	}
    	elseif(isset($_POST['2']))
    	{
    		echo '<h1>Пользователь не удален</h1>';
    		echo '<a href="/admin/users.php" class="btn btn-info">Перейти к пользователям</a>';
    		foot($t);
    		exit;
    	}
    }
    echo '<h1>Удаление пользователя</h1>
    <p>Вы хотите удалить пользователя '.$us['login'].'?<br />
    <form action="users.php?act=delete&amp;id='.$us['id'].'&amp;do" method="post">
	<input type="submit" name="1" value="Да" class="btn btn-danger"/>
	<input type="submit" name="2" value="Нет" class="btn btn-info"/>
	</p>
	</form>';
    break;
}
echo '<a href="/admin/index.php" class="btn btn-info">Админ-панель</a> <a href="/admin/signup.php" class="btn btn-success">Зарегистрировать нового пользователя</a>';
foot($t);
?>