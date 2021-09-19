<?php

class Startup
{
    public function __construct()
    {
        $this->loadClasses();
    }

    public function loadClasses()
    {
        // Получаем список всех файлов в директории за исключением '.' и '..'
        $files = array_diff(scandir(PATH_CLASSES), array('..', '.'));

        // Подключаем все найденные классы
        foreach ($files as $file) {
            $class = PATH_CLASSES . '/' . $file;

            if (file_exists($class)) {
                require_once $class;
            }
        }
    }
}