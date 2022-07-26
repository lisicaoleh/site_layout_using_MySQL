<?php
require 'elems/init.php';// подключаем шапку проекта с подключением к базе данных и стартом сессии

    if(isset($_GET['page'])){// если параметром пеедан url страницы, записываем его в $page
        $page = $_GET['page'];
    }else{
        $page = '/';// если параметром не пеедан url страницы, записываем в $page /
    }
    
    $result = mysqli_query($link, "SELECT * FROM pages WHERE url = '$page'") or die(mysqli_error($link));
    // выбираем данные о станице с базы по url
    $page = mysqli_fetch_assoc($result);
    if(!$page){// если странцы с таким url нет в базе, показываем стрницу 404
        $result = mysqli_query($link, "SELECT * FROM pages WHERE url = '404'") or die(mysqli_error($link));
        $page = mysqli_fetch_assoc($result);
        header("HTTP/1.1 404 Not Found");
    }
    
    $content = $page['text'];// записываем в переменную текст страницы
    $title = $page['title'];// записываем в переменную оглавление страницы
include 'elems/layout.php';// подключаем шаблон где будут доступны выше перечисленные переменные
