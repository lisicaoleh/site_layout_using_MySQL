<!doctype html>
<html>
    <head>
        <link rel="stylesheet" href="../style.css">
    <title><?= $title?></title>
    </head>
    <body>
       <div>
        <header>
            <?php include 'elems/header.php';?><!--подключаем шапку сайта с меню-->
        </header>
        <main>
            <?= $content?><!-- отображаем текст страницы-->
        </main>
        <footer>
            footer
        </footer>
       </div>
    </body>
</html>



