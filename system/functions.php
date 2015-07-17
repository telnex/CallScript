<?php
/* Функция отфильтровки чисел */
function int($int)
{
	return abs((int)$int);
}

/* Функция защиты от нежелательных действий */
function protect($text)
{
	return trim(mysql_real_escape_string(htmlspecialchars($text, ENT_QUOTES, 'utf-8')));
}

/* Функция отображения времени */
function clock($time)
{
	global $user;
	$timep= date("j M Y в H:i:s", $time);
	$time_p[0]=date("j n Y", $time);
	$time_p[1]=date("H:i:s", $time);
	if ($time_p[0]==date("j n Y", time()))$timep='Сегодня в '.$time_p['1'];
	if ($time_p[0]==date("j n Y", time()-86400))$timep='Вчера в '.$time_p['1'];
	$months_eng = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$months_rus = array('Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');
	$timep = str_replace($months_eng,$months_rus,$timep);
	return $timep;
}

function datediff($date1, $date2, $timer = false)
{
    $diff = $date2 - $date1;
    $m=floor(($diff%3600)/60);
    $s=($diff%3600)%60;
    if ($timer == false) {        
        return $m.' мин. '.$s.' сек.';
    } else 
        return '<span id="mins">'.$m.'</span> мин. <span id="secs">'.$s.'</span> сек.';

    
}
/* Функции отображения статуса */
# по ID
function status($online)
{
	$t = @mysql_fetch_assoc(mysql_query("SELECT `time` FROM `users` WHERE `id` = ".$online));
	return ($t['time']+300>time()) ? ' <span class="user_on">[ON]</span> ' : ' <span class="user_off">[OFF]</span> ';
}
 /* Функция только для незарегистрированных пользователей */
function unreg()
{
	global $user;
	if($user)
	{
		header("Location: ../404.php");
	}
}

/* Функция только для зарегистрированных пользователей */
function reg()
{
	global $user;
 	if(empty($user['login']) and empty($user['password']))
 	{
  		header("Location: ../sign.php");
 	}
}

/* Функция для определения уровня пользователя */
function only_level($level=0)
{
    global $user;
 	if (!isset($user) or $user['level']<$level)
	{
  		header("Location: ../index.php");exit;
	}
}
$page = isset($_GET['page']) ? int($_GET['page']) : 0; $i=0;
while($i<$page+$set['str'] or $i==0) $i = $i+100;
if($page+$set['str']>100) $pagefile = $page-$i+100;
else $pagefile = $page;

function pages($page, $total, $href, $num)
{
    echo '<div class="navigation">';
    if ($page) echo '<a href="'.$href.'page='.($page-$num).'" class="btn btn-success">Назад</a> ';
    echo ' ';
    if ($total > $page + $num)
    echo ' <a href="'.$href.'page='.($page + $num).'" class="btn btn-success">Далее</a>';
    if($total>0) {
        echo '<br/><br/>Страницы:';
        $minus = $page-($num*3);
        $plus = $page+($num*4);
        if($minus<$total && $minus>0) echo ' <a href="'.$href.'page=0">1</a> ... ';
        for($i=$minus; $i<$plus;)
        {
            if($i<$total && $i>=0)
            {
                $ii = floor(1+$i/$num);
                if ($page==$i) echo ' <a href="#"class="btn btn-success disabled">'.$ii.'</a>';
                else echo ' <a href="'.$href.'page='.$i.'" class="btn btn-success">'.$ii.'</a>';
            }
            $i=$i+$num;
        }
        if($plus<$total)
        {
            $whole = ceil($total/$num);
            echo ' ... <a href="'.$href.'page='.($whole*$num-$num).'" class="btn btn-success">'.$whole.'</a>';
        }
    }

echo '</div>';
}
/* Функция безопасного шифрования в MD5 */
function md5_sault($text)
{
	return md5(md5('callscript').md5(md5($text)));
}

/* Функция отображения тем */

# Верх
function head($title)
{
	global $user, $set;
    if ($user)
        mysql_query("UPDATE `users` SET `WHERE` = '".$title."' WHERE `id` = ".$user['id']."");
	require BASE.'style/default/head.php';
}

# Низ
function foot()
{
 	global $set, $user, $userid;
	require BASE.'style/default/foot.php';
}
?>