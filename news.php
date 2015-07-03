<?php
require_once 'system/core.php'; // стартуем ядро двигателя
require_once 'system/functions.php'; // стартуем функции
reg();
head('Новости');
$query = mysql_query("SELECT * FROM `news` order by `id` desc limit ".$page.",".$set['str']);
$total = mysql_result(mysql_query("SELECT count(*) FROM `news`"),0);
if($query == 0)
{
    echo '<div class="error">Новостей нет...</div>';
}
else
{
    echo '<table class="table">';
    echo '<tr><td><strong>#Id</strong></td><td><strong>Содержание</strong></td><td><strong>Дата</strong></td></tr>';
    while ($row = mysql_fetch_assoc($query))
    {
        echo '<tr><td>'.$row['id'].'</td><td>'.$row['text'].'</td><td>'.clock($row['time']).'</td></tr>';
    }
    echo '</table>';
}
    if($total > $set['str'])
    {
		pages($page, $total, 'news.php?', $set['str']);
  	}
echo '<a class="btn btn-info" href="/index.php">Вернуться на главную</a>';
foot($t);
?>