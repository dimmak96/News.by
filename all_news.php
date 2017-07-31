<h2>Список всех новостей</h2>
<?php
$per_page=6;
$page=1;
if(isset($_GET['page'])){
	$page=(int)$_GET['page'];
}
$total_count_q=mysqli_query($connection, "SELECT * FROM news");
$total_count=mysqli_num_rows($total_count_q);
$total_pages=ceil($total_count/$per_page);

if($page<=1 or $page>$total_pages){
	$page=1;
}
$offset=($per_page*$page)-$per_page;
$result = mysqli_query($connection, "SELECT * FROM news ORDER BY id DESC LIMIT $offset,$per_page");
$news_exists=true;
if(mysqli_num_rows($result)<=0){
	echo "Статей нет!";
	$news_exists=false;
}?>
<div class="news"><?php
while ($r1 = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-4">
        <div class="title">
            <div>
                <a href="/index.php?url=new-page&id=<?php echo $r1['id']; ?>"><img src="images/<?php echo $r1['image']; ?>"
                                                                    style="width:100%;height:200px;"/></a>
            </div>
            <div><a href="/index.php?url=new-page&id=<?php echo $r1['id']; ?>"><?php echo "<h3>" . $r1['title'] . "</h3>" ?></div>
            </a>
        </div>
        <div><?php echo mb_substr($r1['content'], 0, 50, 'utf-8') ?></div>
        <div><?php echo "<em>Добавлена:</em>" . $r1['creation_date']; ?></div>
        <div>
			<?php
			
				$comments=mysqli_query($connection,"SELECT * FROM comments WHERE new_id=".$r1['id'] );
				echo "<em>Комментариев:</em>".mysqli_num_rows($comments); ?>
		</div>
        <div><?php echo "<em>Просмотров:</em> " . $r1['views']; ?></div>
        <?php echo "<br/>" ?>
    </div>
<?php }?>
</div>
<?php
if($news_exists){
	echo '<div class="paginator" style="margin-bottom:20px;text-align:center">';
	if($page>1){
		echo '<b><a href="index.php?url=all-news&page='.($page-1).'">&laquo;Прошлая страница</a><b>  ';
	}
	if($page!=1 and $page!=$total_pages){
		echo " | ";
	}
	if($page<$total_pages){
		echo '<a href="index.php?url=all-news&page='.($page+1).'">Следующая страница&raquo;</a>';
	}
	echo '</div>';
}

?>

