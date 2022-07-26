<?php
//уничтожаем все данные с сессии
session_start();
session_destroy();
echo '<h1>logout</h1>';
