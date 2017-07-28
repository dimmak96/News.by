<?php require_once "db.php";
$url = $_GET['url'];
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
    <?php require "header.php"; ?>
    <div class="content">
        <?php
        switch ($url) {
            case NULL:
                echo "<p>Главная</p>";
                break;
            case '/':
                echo "<p>Главная</p>";
                break;
            case 'all-news':
                include "all_news.php";
                break;
            case 'add-new':
                include "add_new.php";
                break;
            case 'registration':
                include "registration.php";
                break;
            case 'login':
                include "login.php";
                break;
            case 'logout':
                include "logout.php";
                break;
            case 'new-page';
                include "new.php";
                break;
            default:
                echo "Файл не найден";
                break;
        }
        ?>
    </div>
</div>
</body>
</html>