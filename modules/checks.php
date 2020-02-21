<?php 

class checks{
    // В данный класс вынесены мелкие проверки/процедуры

    function GetScheme($url){ // Переводит URL (aaa.com) в полноценный формат => (http://aaa.com)
        $scheme = parse_url($url, PHP_URL_SCHEME); // Получаем протокол из URL
        if ($scheme == null) { // Если в начале URL нету протокола.
            $url = "http://" . $url; // Добавляем в URL протокол.
        }
        return $url; //Возвращаем нормальный URL
    }

    function IsExistsFileReport($domain){ // Проверяем, существует ли нужный нам файл.
        $filename = $this->CreatPathForFileReport($domain); // Создаем путь для файла.
        $IsExists = file_exists($filename); //Проверка на существование.
        return $IsExists; // Возвращаем True/False
    }

    function InitTotalArray($Link){ // Инициализируем глобальный массив с начальными значениями.
        $TotalAdress = array(); // Создаем массив.

        $TotalAdress["link"][] = $Link; // Заполняем массив
        $TotalAdress["from"][] = $Link;
        $TotalAdress["type"][] = "link";

        return $TotalAdress; // Возвращаем туда, откуда взяли.
    }

    function CreatPathForFileReport($domain){ // Строим путь к файлу с отчетом.
        $filename = "saved/" . $domain . ".csv";
        return $filename; // Возвращаем путь к файлу.
    }
    
}

?>