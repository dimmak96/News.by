<div class="header">
	<div class="navigation">
		<ul>
			<li><a href="/index.php?url=/">Главная</a></li><!--/index.php?url=/ !-->
			<li><a href="/index.php?url=all-news">Все Новости</a></li><!--/index.php?url=all-news !-->
			<?php if(isset($_SESSION['logged_user'])) {?>
			<li><a href="/index.php?url=add-new">Добавить новость</a></li><!--/index.php?url=add-new !-->
			<?php }?>
		</ul>
		<?php if(isset($_SESSION['logged_user'])) {?>
		<ul style="padding-left:80%;">
			<li style="padding-top:25px"><?php echo $_SESSION['logged_user']['login']?></li>
			<li style="margin-left:40px;"><a href="/index.php?url=logout">Выйти</a></li>
		</ul>		
			
		<?php }else{ ?>
		<ul style="padding-left:80%;">
			<li><a href="/index.php?url=login">Вход</a></li>
			<li><a href="/index.php?url=registration">Регистрация</a></li>
			
		</ul>
		<?php } ?>
	</div>
</div>
	