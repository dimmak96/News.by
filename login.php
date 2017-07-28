<h3>Вход</h3>
<?php 
	$data=$_POST;
	if(isset($data['do_login'])){
		$errors=array();
		$result=mysqli_query($connection,"SELECT * FROM users WHERE login='".$data['login']."'");
		if($r1=mysqli_fetch_assoc($result)){
			if(password_verify($data['password'],$r1['password'])){
				$_SESSION['logged_user']=$r1;
				echo '<script>window.location=\'/\';</script>';
				echo '<div class="alert alert-success">'."Вы авторизованы.Можете перейти на <a href=\"/\">главную</a> страницу".'</div>';
			}else{
				$errors[]="Не верно введен пароль";
			}
		}else{
			$errors[]="Пользователь с такие логином не найден";
		}
		if(!empty($errors)){
			echo '<div class="alert alert-danger">'.$errors[0].'</div>';
		}
	}
?>
<form action="/index.php?url=login" method="POST">
	<div class="form-group">
		<label for="login">Логин</label>
		<input type="text" class="form-control" id="login" name="login" value="<?php echo $_POST['login'];?>" placeholder="Логин..."/>
	</div>
	<div class="form-group">
		<label for="password">Пароль</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $_POST['password'];?>" placeholder="Пароль..."/>
	</div>
	<div>
		<button type="submit" name="do_login" class="btn btn-primary">Войти</button>
	</div>
</form>