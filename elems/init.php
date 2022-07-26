<?php
//шапка проекта
error_reporting(E_ALL);
ini_set('display_errors', 'on');

session_start();

$link = mysqli_connect('', '', '', '');
mysqli_query($link, "SET NAMES utf8");


