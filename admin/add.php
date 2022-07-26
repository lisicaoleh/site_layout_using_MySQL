<?php
require '../elems/init.php';

if($_SESSION['auth']) {// проверка аутендификации
    function addPage($link)
    {

        if (isset($_POST['url']) && isset($_POST['title']) && isset($_POST['text'])) {//роверяем заполнены ли все поля в форме

            $url = mysqli_real_escape_string($link, $_POST['url']);//екранируем все специальные символы
            $title = mysqli_real_escape_string($link, $_POST['title']);
            $text = mysqli_real_escape_string($link, $_POST['text']);

            $res = mysqli_query($link, "SELECT COUNT(*) as count FROM pages WHERE url='$url'");
            $isPage = mysqli_fetch_assoc($res);


            if (!$isPage['count']) {//проверка существует ли уже страница с таким url в базе
                $query = "INSERT INTO pages(url, title, text) VALUES ('$url', '$title', '$text')";
                mysqli_query($link, $query) or die(mysqli_error($link));
                //создаем новую страницу в базе

                $_SESSION["message"] = [
                    'info' => 'Page added successfully',
                    'status' => 'success'];
                header('Location: index.php');
                die();

            } else {
                $_SESSION["message"] = [
                    'info' => 'The page has already set with this URL',
                    'status' => 'error'];
            }
        }

    }


    function getPage()
    {
        $url = isset($_POST['url']) ? $_POST['url'] : 'url';
        // если форма уже была заполнена записываем данные
        // с post, конструкцию можно заменить на ??
        $post_title = isset($_POST['title']) ? $_POST['title'] : 'title';
        $text = isset($_POST['text']) ? $_POST['text'] : 'text';

        $content = '<br><br><form action="" method="post">'
            . '<input name="url" value="' . $url . '">'
            . '<br><br><input name="title" value="' . $post_title . '">'
            . '<br><br><textarea name="text">' . $text . '</textarea>'
            . '<br><br><input type="submit" value="добавить">'
            . '</form>';// формируем форму

        $title = 'Создание страниц';
        include 'layout.php';
    }

    addPage($link);
    getPage();
}else{
    header('Location: login.php');
}
