<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg(); // Ограничиваем доступ только зарегистрированным
head('Приглашение на меропрятиятие');
echo '<h1>Приглашение на меропрятиятие</h1>';
if(isset($_GET['newcall'])) {
	mysql_query("UPDATE `block` SET `block1`= 'no', `block2`= 'no', `block3`= 'no' WHERE `user` = '".$user['login']."'");
		// Останавливаем таймер, если пользователь не нажал "Стоп-Звонок"
	$stoptime = mysql_fetch_assoc(mysql_query("SELECT `stop_time` FROM `stat` WHERE `user` = '".$user['id']."' ORDER BY `id` DESC LIMIT 1;"));
	if ($stoptime['stop_time']==0) {
		mysql_query("UPDATE `stat` SET `stop_time`= '".time()."' WHERE `user` = '".$user['id']."' ORDER BY `id` DESC LIMIT 1;");
	}
	// Запускаем таймер
	mysql_query("INSERT INTO `stat` (user,start_time) values ('".$user['id']."','".time()."') ");

}
$ques = protect($_GET['go']); // Переменная содержит ид вопроса
if (empty($ques)) $ques=1;
$query = mysql_query("SELECT * FROM `question` where id=$ques");
$row = mysql_fetch_assoc($query);
if ($row['block']==1) {
	mysql_query("UPDATE `block` SET `block1`= 'yes' WHERE `user` = '".$user['login']."'");
}
elseif ($row['block']==2) {
	mysql_query("UPDATE `block` SET `block2`= 'yes' WHERE `user` = '".$user['login']."'");
}
elseif ($row['block']==3) {
	mysql_query("UPDATE `block` SET `block3`= 'yes' WHERE `user` = '".$user['login']."'");
}
$ans = explode(',', $row['ans']); // Варианты ответов
$go = explode(',', $row['link']); // Ссылки на следующие вопросы, в зависимости от выбранного ответа $ans
echo '<div class="question"><p>'.$row['ques'].'</p></div>';
if ($row['ans']!='') {
	echo '<div class="answer">
	<ul>';
	$block = mysql_fetch_assoc(mysql_query('SELECT * FROM `block` where `user`="'.$user['login'].'"'));
	$i = 0;
	foreach ($ans as &$value) {
		$row = mysql_fetch_array(mysql_query('SELECT * FROM `answers` where `id`= "'.$value.'"'));
		if ($go[$i]=='cond1') {
			if ($block['block1']=='yes') {
				echo '<li><a href="?go=9">'.$row['ans'].'</a></li>';
			}
			elseif ($block['block1']=='no') {
				echo '<li><a href="?go=8">'.$row['ans'].'</a></li>';
			}
		}
		elseif ($go[$i]=='cond2') {
			if ($block['block2']=='yes') {
				echo '<li><a href="?go=20">'.$row['ans'].'</a></li>';
			}
			elseif ($block['block2']=='no') {
				if ($go[$i]=='cond3') {
						if ($block['block3']=='yes') {
							echo '<li><a href="?go=22">'.$row['ans'].'</a></li>';
						}
						elseif ($block['block3']=='no') {
							echo '<li><a href="?go=26">'.$row['ans'].'</a></li>';
						}
					}
				}
		}
		else
			echo '<li><a href="?go='.$go[$i].'">'.$row['ans'].'</a></li>';
		$i++;
	}
	echo "</ul>
			</div>";
}
$time = mysql_fetch_assoc(mysql_query("SELECT `stat`.*,`users`.`login` FROM `stat` INNER JOIN `users` ON `stat`.`user`=`users`.`id` ORDER BY `id` DESC LIMIT 1"));
$diff = datediff($time['start_time'],time(), $timer = true);
echo '<p class="text-info">Время: '.$diff.'</p>';
echo '<script>
			var timer;
			mins = document.getElementById(\'mins\').innerHTML;
			secs = document.getElementById(\'secs\').innerHTML;
			timer = setInterval(
				function () {
					secs++;
					if (secs == 59) {
						mins++;
						secs = 0;
						document.getElementById(\'mins\').innerHTML = mins;
					}
				document.getElementById(\'secs\').innerHTML = secs;
				},
				1000
				);
		</script>';
echo '<a class="btn btn-info btn-large" href="newcall.php?stopcall">Стоп-Звонок</a>';
foot();
?>