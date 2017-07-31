<h3>Добавление новости</h3>
<form enctype="multipart/form-data" method="POST" action="/index.php?url=add-new">
	<?php 
		if(isset($_POST['do_post'])){
			$errors=array();
			if($_FILES["image"]["size"] > 1024*3*1024)
		   {
			 $errors[]="Размер файла превышает три мегабайта";  
		   }
		   // Проверяем загружен ли файл
		   if(is_uploaded_file($_FILES["image"]["tmp_name"]))
		   {
			 // Если файл загружен успешно, перемещаем его
			 // из временной директории в конечную
			 move_uploaded_file($_FILES["image"]["tmp_name"], "images/".basename($_FILES["image"]["name"]));
		   } else {
			   $errors[]="Ошибка загрузки файла";
			  
		   }
			
			if(trim($_POST['content'])==''){
				$errors[]="Введите текст новости";
			}
			if(trim($_POST['title'])==''){
				$errors[]="Введите заголовок";
			}
			if(empty($errors)){
				
				mysqli_query($connection, "INSERT INTO news (creation_date,image,title, content) VALUES (NOW(),'".basename($_FILES["image"]["name"])."','".$_POST['title']."','".$_POST['content']."')");
				
				echo '<div class="alert alert-success">'."Новость успешно добавлена".'</div>';
			} else{
				echo '<div class="alert alert-danger">'.$errors[0].'</div>';
			}
		}
	?>
	<div class="form-group">
		<label for="exampleInputFile">Картинка</label>
		<input type="file" id="exampleInputFile" name='image'>
	</div>
	<div class="form-group">
		<label for="title1">Заголовок:</label><br>
		<input type="text" class="form-control" name="title" id="title1" placeholder="Название новости" value="<?php echo $_POST['title'];?>"/>
	</div>
	<div class="form-group">
		<label for="content">Текст новости:</label><br>
		<textarea class="form-control" rows="6" name="content" id="content" placeholder="Текст новости"><?php echo $_POST['content'];?></textarea>
	</div>
	
	<button type="submit" name="do_post" class="btn btn-primary">Добавить</button>
</form>	
