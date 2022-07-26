<?php
function create_link($href, $ancor){
    if((!isset($_GET['page']) && $href == '/') || (isset($_GET['page']) && $_GET['page'] == $href)){
        $class = " class='active'";
    }else{
        $class = '';
    }//делаем активной ссылку которая совпадает с url сайта
    $hrefget = $href == '/' ? '.' : '?page=';
    return "<a href=\"$hrefget$href\"$class>$ancor<a>";//возвраем готовую ссылку на страницу
}


$result = mysqli_query($link, "SELECT * FROM pages WHERE url != '404'") or die(mysqli_error($link));
//выбираем с базы все страницы кроме 404
$data = [];
while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}
//записываем все данные в масив

foreach ($data as $page) {
    echo create_link($page['url'], $page['text']);// выводим ссылки на все существующие страницы
}
