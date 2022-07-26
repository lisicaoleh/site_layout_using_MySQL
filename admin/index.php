<?php
require '../elems/init.php';

if($_SESSION['auth']) {//проверяем аутендификацию пользователя
    function showPage($link)
    {
        $result = mysqli_query($link, "SELECT id, title, url FROM pages WHERE url != '404'") or die(mysqli_error($link));
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;// записисываем в массив все страницы с базы кроме 404
        }
        $content = "<table>"
            . "<tr>"
            . "<th>title</th>"
            . "<th>url</th>"
            . "<th>edit</th>"
            . "<th>delete</th>"
            . "</tr>";
        foreach ($data as $page) {
            $content .=
                "<tr>"
                . "<td>{$page['title']}</td>"
                . "<td>{$page['url']}</td>"
                . "<td><a href=\"edit.php?id={$page['id']}\">edit</a></td>"
                . "<td><a href=\"?delete={$page['id']}\">delete</a></td>"
                . "</tr>";
        }// формируэм контент страницы
        $content .= "</table>";
        $title = "Admin page";

        require 'layout.php';
        unset($_SESSION['message']);//очищаем сессию с сообщением
    }


    function deletePage($link)
    {
        if (isset($_GET['delete'])) {// проверка передан ли get на удаление страницы
            $query = "DELETE FROM pages WHERE id = {$_GET['delete']}";
            mysqli_query($link, $query) or die(mysqli_error($link));// удаляем страницу с переданім url
            $_SESSION["message"] = [// записываем в сессию сообщение об удалении
                'info' => 'Delete was successfully',
                'status' => 'success'];
            header('Location: ./');
            die();
        }
    }

    deletePage($link);
    showPage($link);
}else{// при отсутствии аутендификации редиректим на файл с вводом пароля
    header('Location: login.php');
}


