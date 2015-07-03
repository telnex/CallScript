<?php
	header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?> | <?php echo $set['site']; ?></title>
<link href="/style/default/css/bootstrap.css" rel="stylesheet" type='text/css' />
<!-- Custom Theme files -->
<link href="/style/default/css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<script src="/style/default/js/jquery.min.js"></script>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="" />
<link href="/style/default/css/nav.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Resource jQuery -->
</head>
<body>
	<div class="total-content">
		<div class="col-md-3 side-bar">
			<div class="logo text-center">
				<a href="/"><img src="/style/default/images/logo.png" alt="" title="Перейти на главную" /></a>
			</div>
			<div class="navigation">
				<h3>Навигация</h3>
				<ul>
					<li><a href="/script.php"><i class="fat"></i></a></li>
					<li><a href="/script.php">Скрипты</a></li>
				</ul>
				<ul>
					<li><a href="/cab.php"><i class="art"></i></a></li>
					<li><a href="/cab.php">Личный кабинет</a></li>
				</ul>
				<ul>
					<li><a href="/stat.php"><i class="dash"></i></a></li>
					<li><a href="/stat.php">Статистика</a></li>
				</ul>
				<ul>
					<li><a href="/rating.php"><i class="chat"></i></a></li>
					<li><a href="/rating.php">Рейтинг</a></li>
				</ul>
				<ul>
					<li><a href="/online.php"><i class="user"></i></a></li>
					<li><a href="/online.php">Онлайн</a></li>
				</ul>
				<ul>
					<li><a href="/help.php"><i class="faq"></i></a></li>
					<li><a href="/help.php">Справка</a></li>
				</ul>
			</div>
			<?php if (isset($user) && $user['level']==3)
					echo '<div class="navigation">
							<h3>Админ-панель</h3>
							<ul>
								<li><a href="/admin/index.php"><i class="setting"></i></a></li>
								<li><a href="/admin/index.php">Настройки</a></li>
							</ul>
						</div>'; ?>		
		</div>
		<div class="col-md-9 content">
			<div class="home-strip">
				<div class="view">
					<ul>
						<li><a href="/" title="Перейти на главную"><i class="refresh"></i></a></li>
						<li>
							<?php 
							$query = mysql_query("SELECT * FROM `news` order by `id` desc limit 3");
							$total = mysql_result(mysql_query("SELECT count(*) FROM `news`"),0);
							if($query == 0)
							{
								echo '<div class="error">Уведомлений нет</div>';
							}
							else
							{
								echo '<div id="dd3" class="wrapper-dropdown-3"><i class="bell"class="notification_header"></i><span class="blue">'.$total.'</span>';
								echo '<ul class="dropdown">
										<div class="notification_header">
										<h3>Уведомлений: '.$total.'.</h3>
										</div>';
								while ($row = mysql_fetch_assoc($query))
								    {
								        echo '<li>
												<div class="notification_desc">
											<p>'.$row['text'].'</p>
											<p><span>'.clock($row['time']).'</span></p>
											</div>
											<div class="clear"> </div>
									</li>';
								    }
							}
							?>
									<div class="notification_bottom">
										<h3><a href="/news.php">Перейти в раздел "Уведомления"</a></h3>
									</div> 
								</ul>
							</div>
							<!-----start-script---->
							<script type="text/javascript">
								function DropDown(el) {
									this.dd3 = el;
									this.initEvents();
								}
								DropDown.prototype = {
									initEvents : function() {
										var obj = this;
					
										obj.dd.on('click', function(event){
											$(this).toggleClass('active');
											event.stopPropagation();
										});	
									}
								}
								$(function() {
					
									var dd3 = new DropDown( $('#dd3') );
					
									$(document).click(function() {
										// all dropdowns
										$('.wrapper-dropdown-3').removeClass('active');
									});
					
								});
							</script>
						</li>
					</ul>
				</div>
				<div class="member">
					<p><a href="/cab.php"><i class="men"></i></a><a href="/cab.php"><?php if (isset($user['id'])) 
					echo $user['name'];
					else echo 'Гость'; ?></a></p>
					<div id="dd" class="wrapper-dropdown-2" tabindex="1"><span><img src="/style/default/images/settings.png"/></span>
						<ul class="dropdown">
							<li><a href="/cab.php">Профиль</a></li>
							<li><a href="/help.php">Помощь</a></li>
							<li><a href="/sign.php?exit">Выход</a></li>
						</ul>
					</div>
				<!-- end-wrapper-dropdown-2 -->
				<!-- start-script -->
					<script type="text/javascript">
							function DropDown(el) {
								this.dd = el;
								this.initEvents();
							}
							DropDown.prototype = {
								initEvents : function() {
									var obj = this;
				
									obj.dd.on('click', function(event){
										$(this).toggleClass('active');
										event.stopPropagation();
									});	
								}
							}
							$(function() {
				
								var dd = new DropDown( $('#dd') );
				
								$(document).click(function() {
									// all dropdowns
									$('.wrapper-dropdown-2').removeClass('active');
								});
				
							});
					</script>
				<div class="clearfix"></div>			
			</div>
			<div class="enter">
				<?php 
					if (isset($user['id']))
						echo '<a href="/sign.php?exit" class="btn btn-large btn-block btn-danger">Выйти</a>';
					else
						echo '<a href="/sign.php" class="btn btn-large btn-block btn-danger">Войти</a>';
				?>
			</div>
			<div class="clearfix"></div>	
				</div>
				<div class="clearfix"></div>
			<p class="home"><a href="#">Главная</a> > <strong> <?php echo $title; ?></strong></p>
			<div class="block-call">
