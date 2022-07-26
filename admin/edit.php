<?php
require '../elems/init.php';

if($_SESSION['auth']) {
    function editPage($link)
    {
        if (!empty($_POST)) {// проверка передали ли данные с формы
            $id = $_GET['id'];// записиваем id что предано в get

            $res = mysqli_query($link, "SELECT * FROM pages WHERE id='$id'") or die(mysqli_error($link));
            $Page = mysqli_fetch_assoc($res);//записываем все данные о странице по id


            if ($Page['id']) {//проверяем существует ли страница с таким id в базе

                if ($Page['url'] !== $_POST['url']){ // если в форме был изменён url
                    $res = mysqli_query($link, "SELECT COUNT(*) as count FROM pages WHERE url='{$_POST['url']}'") or die(mysqli_error($link));
                    $isPage = mysqli_fetch_assoc($res);// птаемся найти страницу с url что передан в форме в базе

                    if ($isPage['count']) {//ели страница с таким url уже существует в базе формируэм сообщение
                        $_SESSION['message'] = [
                            'info' => 'Page with this url is already set',
                            'status' => 'error'];
                        return 0;// завершаем работу функции
                    }
                }
                $query = "UPDATE pages SET url = '{$_POST['url']}', title = '{$_POST['title']}', text = '{$_POST['text']}' WHERE id = '$id'";
                mysqli_query($link, $query) or die(mysqli_error($link));
                // записываем новие значения страницы в базу
                $_SESSION['message'] = ['info' => 'Page change successfully', 'status' => 'success'];
                header('Location: ./');
                die();
            } else {
                $_SESSION['message'] = ['info' => 'Page not found', 'status' => 'error'];
            }
        }
    }


    function getPage($link)
    {

        $result = mysqli_query($link, "SELECT * FROM pages WHERE id='{$_GET['id']}'");
        $page = mysqli_fetch_assoc($result);//выбираем станицу с базы по переданому get id
        if ($page) {//проверяем есть ли такая страница в базе
            $url = isset($_POST['url']) ? $_POST['url'] : $page['url'];// если форма уже была заполнена записываем данные
            // с post иначе записываем данные с базы, конструкцию можно заменить на ??
            $title = isset($_POST['title']) ? $_POST['title'] : $page['title'];
            $text = isset($_POST['text']) ? $_POST['text'] : $page['text'];

            ob_start();
            include "elems/form.php";// подключаем форму где будут доступны $url, $title, $text
            $content = ob_get_clean();

        } else { //если страницы с таким id в базе нет
            $content = 'Page not found';
            $title = 'Not found';
        }
        include 'layout.php';

        unset($_SESSION['message']);
    }

    editPage($link);
    getPage($link);
}else{
    header('Location: login.php');
}

