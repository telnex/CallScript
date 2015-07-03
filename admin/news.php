<?php
/**
 *
 * This software is distributed under the GNU LGPL v3.0 license.
 * Pirate's project
 * PostEngine
 * @author Vladyslav Karpenko <Pirate aka Nervous> AND Egor Smolyakov <EuroDesign aka iNeeXT>
 * @copyright 2008-2010
 * @license http://www.gnu.org/licenses/lgpl-3.0.txt
 * @link http://postengine.ru
 * @version 1.3
 */
require_once '../system/core.php'; // стартуем ядро двигателя
require_once '../system/functions.php'; // стартуем функции
only_level(3);
head('Панель управления > Уведомления');
echo '<h1>Уведомления</h1>';
switch($act)
{
    default:
  	echo '<p><a class="btn btn-success" href="?act=new">Добавить уведомление</a></p>';
    $query = mysql_query("SELECT `id`,`text`,`time` FROM `news` order by `id` desc limit ".$page.",".$set['str']."");
    $total = mysql_result(mysql_query("SELECT count(*) FROM `news`"),0);
    echo '<table class="table">';
	echo '<tr><td><strong>#Id</strong></td><td><strong>Содержание</strong></td><td><strong>Дата</strong></td><td><strong>Действие</strong></td></tr>';
	while ($row = mysql_fetch_assoc($query))
	{
		echo '<tr><td>'.$row['id'].'</td><td>'.$row['text'].'</td><td>'.clock($row['time']).'</td>';
  		echo '<td><a href="news.php?act=edit&amp;id='.$row['id'].'">[редактировать]</a> | <a href="news.php?act=delete&amp;id='.$row['id'].'">[удалить]</a></td></tr>';
	}
	echo '</table>';
    if($total > $set['str'])
    {
		pages($page, $total, 'news.php?', $set['str']);
  	}
  	echo '<a class="btn btn-danger" href="?act=drop">Удалить ВСЕ уведомления</a>';
    break;
	/*Edit*/
    case 'edit':
    $news = mysql_fetch_assoc(mysql_query("SELECT * FROM `news` WHERE `id` = '".int($_GET['id'])."'"));
    if(!$news)
    {
    	echo '<div class="alert alert-error">Уведомление не найдено!</div>';
    	foot($t);
    	exit;
    }
    if(isset($_POST['text']) and !empty($_POST['text']))
	{
 		mysql_query("UPDATE `news` SET
		text='".nl2br(protect($_POST['text']))."'
		WHERE `id`=".$news['id']);
  		echo '<div class="alert alert-success">Данные успешно изменены!</div>';
		foot($t);
		exit;
	}
	echo '<form action="news.php?act=edit&amp;id='.$news['id'].'" method="post">
	<textarea rows="5" cols="40" type="text" name="text">'.$news['text'].'</textarea><br />
	<input type="submit" value="Изменить" class="btn btn-success"/></form>';
    break;
	/*Delete*/
	case 'delete':
    $news = mysql_fetch_assoc(mysql_query("SELECT * FROM `news` WHERE `id` = ".int($_GET['id'])));
    if(!$news)
    {
    	echo '<div class="alert alert-error">Уведомление не найдено!</div>';
    	foot($t);
    	exit;
    }
    if(isset($_GET['do']))
    {
    	if(isset($_POST['1']))
    	{
    		mysql_query("delete FROM `news` WHERE `id` = ".$news['id']."");
    		echo '<div class="alert alert-success">Уведомление успешно удалено!</div>';
    		foot($t);
    		exit;
    	}
    	elseif(isset($_POST['2']))
    	{
    		echo '<p><a href="news.php">Перейти к уведомлениям</a></p>';
    		foot($t);
    		exit;
    	}
    }
    echo '<p>Удалить уведомление?<br />
    <form action="news.php?act=delete&amp;id='.$news['id'].'&amp;do" method="post">
    <div class="form-actions">
   	<input type="submit" name="1" value="Да" class="btn btn-danger"/>
	<input type="submit" name="2" value="Нет" class="btn btn-success"/>
	</div>
	</form>';
    break;
	case 'new':
	if(isset($_POST['text']) and !empty($_POST['text']))
	{
		mysql_query ("INSERT INTO `news` (text,time) VALUES ('".nl2br(protect($_POST['text']))."',".time().")");
		echo '<div class="alert alert-success">Уведомление успешно создано!</div>';
	}
	echo '<form method="post" action="news.php?act=new">
	<p>Название:<br />
	<textarea type="text" name="text" rows="5" cols="40"></textarea><br />
	<input type="submit" value="Добавить" class="btn btn-success"/></p>
	</form>';
	break;
 	case 'drop':
  	mysql_query("TRUNCATE TABLE `news`");
	echo '<div class="alert alert-success">Все уведомления успешно удалены!</div>';
	break;
}
foot($t);
?>