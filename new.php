<?php
 require_once "db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Новости</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" href="/css/styles.css" type="text/css"/>
	<script src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</head>
<body style="background: url(images/_mg_1583_22_36dr.jpg) no-repeat">
	<div class="container">
<!--		--><?php //require "header.php";?>
		<div class="content">
			<?php
				$new=mysqli_query($connection, "SELECT * FROM news WHERE id=".$_GET['id']);
				
				if(mysqli_num_rows($new)<=0){
					?>
					<h2>Статья на найдена<h2>
					<div>Запрашиваемая вами статья не существует</div>
					<?php
				}else{
					$r1=mysqli_fetch_assoc($new);
					mysqli_query($connection,"UPDATE news SET views = views + 1 WHERE id=".$r1['id']);
					?>
					<p class="views"><?php echo $r1['views'];?> просмотров</p>
					<div style="margin-top:10px;">
						<p style="text-align:center;">
						<img src="images/<?php echo $r1['image'];?>" style="width:50%;"/>
						</p>
					</div>
					<div>
						<?php echo '<h3 style="text-align:center;">'.$r1['title']."</h3>"?>
					</div>
					<div>
						<?php echo $r1['content']?>
					</div>
					
					<div style="height:200px;background-color:#6c7684;margin-top:40px;margin-bottom:10px">
						
							<p style="text-align:left;padding-top:10px;padding-left:10px;">Комментарии:</p>
							<a style="color:black;" href="#add-comment-form"><p class="add-comment-link" onclick="document.getElementById('add-comment-form').style.display='block'">Добавить свой</p></a>
						
					</div>
					<div id="add-comment-form">
					<form>
						<h5 style="text-align:center;padding-top:10px;">Добавить комментарий<h5>
						<br/>
						<textarea class="form-control" rows="2" style="width:50%;margin-left:25%"  placeholder="Комментарий"></textarea>
						<br/>
						<p style="text-align:center;padding-bottom:10px;">
						<button type="submit" class="btn btn-primary">Добавить комментарий</button>
						</p>
					</form>
					</div>
					<?php 
				}
					?>
		</div>
	</div>
</body>
</html>