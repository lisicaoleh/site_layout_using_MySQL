<?php
require '../elems/init.php';

if(isset($_POST['password']) && md5($_POST['password']) == '4a7d1ed414474e4033ac29ccb8653d9b'){
    // проверяем введён ли пароль и равен ли он 0000
    $_SESSION['auth'] = true;//метка аутендификации пользователя
    $_SESSION["message"] = [
        'info' => 'you login successfully',
        'status' => 'success'];
    header('Location: index.php');die();
}else{
    ?>
    <form method="post">
        <input type = 'password' name = 'password'>
        <input type = 'submit' value = 'login'>
    </form>
    <?php
}