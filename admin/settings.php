<?php
require_once '../system/core.php'; // стартуем ядро двигателя
require_once '../system/functions.php'; // стартуем функции
require_once '../system/core.php'; // стартуем ядро двигателя
require_once '../system/functions.php'; // стартуем функции
only_level(3);
head('Настройка системы');
echo '<h1>Настройка системы</h1>';
if(isset($_POST['reg_mail']) and !empty($_POST['reg_mail']))
{
	/* Выполняем запросы на обновление */
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['keywords'])."' WHERE `id` = 'keywords'");
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['description'])."' WHERE `id` = 'description'");
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['http'])."' WHERE `id` = 'http'");
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['site'])."' WHERE `id` = 'site'");
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['str'])."' WHERE `id` = 'str'");
 	mysql_query("UPDATE `settings` SET value='".protect($_POST['reg_mail'])."' WHERE `id` = 'reg_mail'");
 	echo '<div class="alert alert-success">Настройки успешно изменены!</div>';
}
echo '<form action="settings.php" method="post">
<p>Ключевые слова: (для поисковиков)<br/>
<textarea cols="20" rows="3" name="keywords" id="keywords">'.$set['keywords'].'</textarea><br />
Описание сайта: (для поисковиков)<br />
<textarea cols="20" rows="3" name="description" id="description">'.$set['description'].'</textarea><br />
HTTP-адресс сайта: (например: http://site.ru/)<br />
<input name="http" value="'.$set['http'].'" /><br />
Название сайта в верхних блоках:<br />
<input name="site" value="'.$set['site'].'" /><br />
Пунктов на страницу в навигации:<br />
<input name="str" value="'.$set['str'].'" /><br />
Адресс E-MAIL с которого приходит оповещение о регистрации:<br />
<input name="reg_mail" value="'.$set['reg_mail'].'" /><br />
</p>
<div class="form-actions">
  <button type="submit" class="btn btn-success">Сохранить</button>
  <a href="/admin/index.php" class="btn btn-info">Отменить</a>
</div>
</form>';
foot($t);
?>