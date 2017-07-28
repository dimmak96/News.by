<?php
	if(!$connection){
		$connection=mysqli_connect('127.0.0.1', 'root', '', 'news');
		
		if($connection==false){
			echo "Ошибка. Не удалось подключиться.";
			exit();
		}
	}
	session_start();
 ?>