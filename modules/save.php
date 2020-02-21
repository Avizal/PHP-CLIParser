<?php 

class save {

    function saving($domain, $arrayLinks) { // Сохраняем данные в файл

        $pathsave = "saved/" . $domain . ".csv"; //Создаем Путь сохранения

        file_put_contents($pathsave, "!!!"); // Просто создаем файл для дальнейшей перезаписи.

        $fp = fopen($pathsave, 'w+'); // Открыть файл для записи + параметры
        
        foreach ($arrayLinks as $fields) { // Записываем данные в файл.
            fputcsv($fp, $fields);
        }
        
        fclose($fp); // Закрываем файл после записи в него.

        echo "Результаты сохранены!\n"; // Просто сообщение об успехе
        echo "Путь к файлу: " . $pathsave; // Путь к файлу с результатами, начинается от корня программы.

    }


}

?>