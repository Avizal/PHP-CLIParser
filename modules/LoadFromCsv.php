<?php 
class LoadFromCsv {

    function load($inputPath) { // Загружаем данные из CSV файла 
        
        $row_delimiter = ""; // Задаем разделитель строк
        $col_delimiter = ','; // Задаем разделитель столбцов
        
        $content = trim(file_get_contents($inputPath)); // Загружаем содержимое файла в переменную.
    
        // определим разделитель строк в CSV файле
        if ( ! $row_delimiter ){
            $row_delimiter = "\r\n";
            if (false === strpos($content, "\r\n"))
                $row_delimiter = "\n";
        }
    
        $lines = explode($row_delimiter, trim($content)); // Разделяем содержимое файла на строки
        $lines = array_filter( $lines ); // Фильтруем массив
        $lines = array_map( 'trim', $lines );
    
        $data = array(); // Инициализируем переменную.
        foreach( $lines as $key => $line ){
            $data[] = str_getcsv( $line, $col_delimiter ); // Преобразуем полученные строки в массив
            unset( $lines[$key] ); // Удаляем ненужный элемент в массиве.
        }
    
        return $data; // Возвращаем готовый, нормальный массив.
        
    }

}

?>