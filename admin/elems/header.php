<?php

if(isset($_SESSION['message'])){// если существует сессия с сообщением формируем переменную с сообщением
    $info = $_SESSION['message']['info'];
    $status = $_SESSION['message']['status'];
    $info = "<h2 class='$status'>$info</h2>";
}else{
    $info = '';
}

