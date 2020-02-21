<?php 
class merger{
    function MergeringLinks($parent, $Arrlinks) { //Добавление новых ссылкок в общий массив.
        global $TotalAdress; // Получаем новые данные о общем массиве.
        global $TotalForSearch; // Получаем данные о массиве с сылками для поиска.

        foreach ($Arrlinks as $link) { // перебираем новые ссылки

            $IsFound = false; // Для совпадений
            foreach ($TotalAdress["link"] as $adres) { //Ищем совпадения,  
                if ($link == $adres) {//если есть совпадения
                    $IsFound = true; // указываем, что совпадения найдены.
                    break;  //останавливаем поиск.
                }
            }
            if (!$IsFound) {  // Если совпадений нету, то добавляем новую ссылку в общий массив
                $TotalAdress["link"][] = $link; //Добавляем найденную ссылку в общий массив.
                $TotalAdress["from"][] = $parent; // Указываем на какой странице найдена новая ссылка.
                $TotalAdress["type"][] = "link"; //Указываем тип ссылки. Что ссылка на страницу.
            }

            $IsFound = false; // Для совпадений
            foreach ($TotalForSearch as $adres) { // Поиск совпадений
                if ($link == $adres) { // если совпадения есть.
                    $IsFound = true; // указываем, что совпадения найдены.
                    break; // останавливаем поиск.
                }
            }
            if (!$IsFound) { //Если совпадений ранее не найдено.
                $TotalForSearch[] = $link; // добавляем новую ссылку в список для поиска.
            }
        }
    }

    function MergeringImages($parent, $Arrlinks) { // Добавление новых ссылок на картинки.
        global $TotalAdress; // Получаем свежие данные о массиве.

        foreach ($Arrlinks as $link) { // перебираем новые ссылки.
            

            $IsFound = false; // указываем что совпадений пока не было
            foreach ($TotalAdress["link"] as $adres) { // перебираем общий массив с ссылками.
                if ($link == $adres) { // если совпадения найденны
                    $IsFound = true; // указываем что совпадения найденны
                    break; // останавливаем перебор.
                }
            }
            if (!$IsFound) { // если совпадений найдено не было
                $TotalAdress["link"][] = $link; // добавляем новую ссылку в общий массив
                $TotalAdress["from"][] = $parent; // указываем где нашли ссылку
                $TotalAdress["type"][] = "img"; // указываем что ссылка на изображение.
            }
        }
    }
}


?>