<?php
// Used PHP version 7.4;
// Created by Avizal (Ruslan Prichepa) 21.02.2020


require_once "modules/help.php"; //Подключение внешнего файла.
require_once "modules/parse.php"; //Подключение внешнего файла.
require_once "modules/merger.php";
require_once "modules/save.php";
require_once "modules/load.php";
require_once "modules/report.php";
require_once "modules/checks.php";

//Создание объектов.
$help = new help;
$parce = new parse;
$save = new save;
$loadcsv = new loadfromcsv;
$Report = new Report;
$Checks = new checks;

$arguments = $argv; // Входные аргументы
$IsHelp = true; // Нужно ли показать справку пользователю.


if (count($arguments) > 2) { // Если предоставлено достаточно аргументов для начала работы.
    $url = $Checks->GetScheme($arguments[2]); // Переводим URL в нормальный вид
    $domain = parse_url($url, PHP_URL_HOST); //Получаем домен. Обязательно должно быть после определения протокола! 

    if ($arguments[1] == "report") { // Если от нас хотят отчёт.
        $IsHelp = false; // Если пользователю нет необходимости показывать справку.
        $IsExists = $Checks->IsExistsFileReport($domain); //Проверяем, существует ли необходимый файл для отчета.

        if ($IsExists) { //Если файл найден.
            $LoadData = $loadcsv->load($Checks->CreatPathForFileReport($domain)); // Загружаем данные из файла
            $Report->OutputDataReport($LoadData); // Выводим данные в консоль
        } else {
            echo "Результатов по данному домену не найдено!";
        }
    }
    else if ($arguments[1] == "parse") { //Если от нас хотят спарсить сайт.
        $IsHelp = false; // Если пользователю нет необходимости показывать справку.
        $TotalAdress = $Checks->InitTotalArray($url); // Инициализируем массив и заполняем начальными данными.
        $TotalForSearch[] = $url; // Указываем начальную страничку для парсинга

        $parce->StartParse(); //Запускает парсер.

        $save->saving($domain, $TotalAdress); // Сохраняет данные в файл.
    }

}

if ($IsHelp) { // Если пользователю нужно показать справку.
    $help->GetHelp();// Показываем справку.
}

echo "\nКонец выполнения программы"; // Просто сообщаем, о завершении работы программы.

 ?>
