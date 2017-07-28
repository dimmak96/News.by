<h2>Список всех новостей</h2>
<?php
$result = mysqli_query($connection, "SELECT * FROM news");
while ($r1 = mysqli_fetch_assoc($result)) {
    ?>
    <div class="col-md-4">
        <div class="title">
            <div>
                <a href="/index.php?url=new-page&id=<?php echo $r1['id']; ?>"><img src="images/<?php echo $r1['image']; ?>"
                                                                    style="width:100%;"/></a>
            </div>
            <div><a href="/index.php?url=new-page&id=<?php echo $r1['id']; ?>"><?php echo "<h3>" . $r1['title'] . "</h3>" ?></div>
            </a>
        </div>
        <div><?php echo mb_substr($r1['content'], 0, 50, 'utf-8') ?></div>
        <div><?php echo "Добавлена:" . $r1['creation_date']; ?></div>
        <div><?php echo "<em>Комментариев:</em> 0"; ?></div>
        <div><?php echo "<em>Просмотров:</em> " . $r1['views']; ?></div>
        <?php echo "<br/>" ?>
    </div>
<?php }
?>

