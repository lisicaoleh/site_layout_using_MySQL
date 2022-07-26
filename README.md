# site_layout_using_MySQL

Движок сайта написаный на нативном PHP

Для запуска проекта необходимо создать базу данных в MySQL
Выполните следующий код в базе

CREATE DATABASE `pages_list`;

CREATE TABLE `pages` (`id` INT(11) AUTO_INCREMENT, 
`url` VARCHAR(30),
`title` VARCHAR(30),
`text` TEXT,
PRIMARY KEY (`id`));

INSERT INTO `page` (`id`, `url`, `title`, `text`) VALUES (NULL, '/', 'index', 'index'),
(NULL, 'about', 'about', 'about'),
(NULL, '404', 'file_not_found', 'file_not_found');

Далее в файл elems/init.php допишите host, login, password, database_name
