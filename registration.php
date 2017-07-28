<h3>Регистрация</h3>
<?php 
	$data=$_POST;
	if(isset($data['do_registration'])){
		$errors=array();
		if(trim($data['login'])==''){
			$errors[]="Введите логин";
		}
		if(trim($data['email'])==''){
			$errors[]="Введите email";
		}
		if($data['password']==''){
			$errors[]="Введите пароль";
		}
		if($data['password_2']!=$data['password']){
			$errors[]="Повторный пароль введен не верно";
		}
		$result=mysqli_query($connection,"SELECT login FROM users WHERE login='".$data['login']."'");
		if($r1=mysqli_fetch_assoc($result)){
			$errors[]="Пользователь с такие логином уже существует";
		}
		$result=mysqli_query($connection,"SELECT email FROM users WHERE email='".$data['email']."'");
		if($r1=mysqli_fetch_assoc($result)){
			$errors[]="Пользователь с таким email уже существует";
		}
		
		if(empty($errors)){
			mysqli_query($connection, "INSERT INTO users (login, email, password) VALUES ('".$data['login']."','".$data['email']."','".password_hash($data['password'],PASSWORD_DEFAULT)."')");
			echo '<div class="alert alert-success">'."Вы успешно зарегестрировались".'</div>';
		}else{
			echo '<div class="alert alert-danger">'.$errors[0].'</div>';
		}
	}
	
?>
<form action="/index.php?url=registration" method="POST">
	<div class="form-group">
		<label for="login">Логин</label>
		<input type="text" class="form-control" id="login" name="login" value="<?php echo $_POST['login'];?>" placeholder="Логин..."/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?php echo $_POST['email'];?>" placeholder="Email..."/>
	</div>
	<div class="form-group">
		<label for="password">Пароль</label>
		<input type="password" class="form-control" id="password" name="password" value="<?php echo $_POST['password'];?>" placeholder="Пароль..."/>
	</div>
	<div class="form-group">
		<label for="password_2">Введите пароль еще раз</label>
		<input type="password" class="form-control" id="password_2" name="password_2" value="<?php echo $_POST['password_2'];?>" placeholder="Пароль..."/>
	</div>
	<div>
		<button type="submit" name="do_registration" class="btn btn-primary">Зарегестрироваться</button>
	</div>
</form>