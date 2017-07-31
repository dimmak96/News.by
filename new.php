

    <div class="content">
        <?php
        $new = mysqli_query($connection, "SELECT * FROM news WHERE id=" . $_GET['id']);

        if (mysqli_num_rows($new) <= 0){
        ?>
        <h2>Статья на найдена
            <h2>
                <div>Запрашиваемая вами статья не существует</div>
                <?php
                } else {
                    $r1 = mysqli_fetch_assoc($new);
                    mysqli_query($connection, "UPDATE news SET views = views + 1 WHERE id=" . $r1['id']);
                    ?>
                    <p class="views"><?php echo $r1['views']+1; ?> просмотров</p>
                    <div style="margin-top:10px;">
                        <p style="text-align:center;">
                            <img src="images/<?php echo $r1['image']; ?>" style="width:50%;"/>
                        </p>
                    </div>
                    <div>
                        <?php echo '<h3 style="text-align:center;">' . $r1['title'] . "</h3>" ?>
                    </div>
                    <div>
                        <?php echo $r1['content'] ?>
                    </div>
					<div class="warning-message"></div>
					<div style="margin-top:10px;">
					
						<?php
							if(isset($_POST['do_post'])){
								$errors=array();
							if(!isset($_SESSION['logged_user'])){
								$errors[]='Для того чтобы оставить комментарий сначала <a href="/index.php?url=login">авторизуйтесь<a>';
							}	
							if($_POST['text']==''){
								$errors[]="Добавьте текст комментария";
								}
							if(empty($errors)){
								mysqli_query($connection,"INSERT INTO comments (author, text, pubdate, new_id) VALUES ('".$_SESSION['logged_user']['login']."','".$_POST['text']."',NOW(),'".$r1['id']."')");
								
							}else{
								echo '<div class="alert alert-danger">'.$errors['0'].'</div>';
								}
							}
						?>
					</div>
                    <div style="background-color:#6c7684;margin-top:20px;margin-bottom:10px">
					
                        <p style="text-align:left;float: left;padding-top:10px;padding-left:10px;">Комментарии:</p>
                        <a style="color:#333333;float: right;padding-top: 10px;" href="#add-comment-form"><p class="add-comment-link" onclick="document.getElementById('add-comment-form').style.display='block';">Добавить свой</p></a>
						<?php
							$comments=mysqli_query($connection,"SELECT * FROM comments WHERE new_id=".(int)$r1['id']." ORDER BY id DESC");
							if (mysqli_num_rows($comments) <= 0){
								echo '<p style="padding-top:40px;padding-bottom:10px;"><em>Нет комментариев</em></p>';
							}else{?>
								<div class="comments" style="padding-top:40px;">
									<?php
									while($comment=mysqli_fetch_assoc($comments)){
										?>
										
										<div class="comment" style="height:100%;">
											<div style=" width:100%; height:1px; clear:both;"></div>
											<div style="float:left;">
												<p><?php echo "<em><b>".$comment['author']."</b></em> ".'<span style="font-size:10px;">'.$comment['pubdate']."</span>:"; ?></p>
												<p class="comment-text"><?php echo $comment['text']; ?></p>
												<p>&#10084; <?php echo $comment['likes']; ?></p>
											</div>
											<div style="float:right;">
												<p class="icons" style="display:none;">
													<button class="icon like">&#10084;</button>
													<button class="icon delete">&#10006;</button>
													<button class="icon edit">&#9998;</button>
												</p>
												
											</div>
											<div style=" width:100%; height:1px; clear:both;"></div>
										</div>
										<hr>
										
										<?php
									}?>
								</div>
								<?php
							}
						?>
                    </div>
                    <div id="add-comment-form">
                        <form method="POST" action="/index.php?url=new-page&id=<?php echo $r1['id']; ?>">
							
                            <h5 style="text-align:center;padding-top:10px;">Добавить комментарий
                                </h5>
                                    <br/>
									<div class="form-group">
										<textarea class="form-control" name="text" rows="2" style="width:50%;margin-left:25%" placeholder="Комментарий"></textarea>
									<p style="margin-left:65%;padding-top:10px;">
										<a href="#" class="comment-icons"><img src="images/photo-camera-4_icon-icons.com_56244.png" style="width:5%;"/></a>
										<a href="#" class="comment-icons"><img src="images/video-camera-1.png" style="width:5%"/></a>
										<a href="#" class="comment-icons"><img src="images/music-note.png" style="width:5%"/></a>
									</p>
									</div>
                                    
                                    <br/>
                                    <p style="text-align:center;padding-bottom:10px;">
                                        <button type="submit" name="do_post" class="btn btn-primary">Добавить комментарий</button>
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