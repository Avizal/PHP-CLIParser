<?php

namespace App\Classes;

class Startup
{
    protected $arguments;

    public function __construct()
    {
        $this->arguments = new Arguments();

        //$this->loadClasses();
    }

    public function loadClasses()
    {
        // Получаем список всех файлов в директории за исключением '.' и '..'
        $files = array_diff(scandir(PATH_CLASSES), array('.', '..'));

        // Подключаем все найденные классы из папки "app/classes"
        foreach ($files as $file) {
            $class = PATH_CLASSES . '/' . $file;

            if (file_exists($class)) {
                require_once $class;
            }
        }
    }

    public function start()
    {
        $response = null;

        if ($this->isNeedHelp()) {
            $response = $this->getHelp();
        }

        echo $response;
    }

    protected function isNeedHelp(): bool
    {
        return true;
    }

    protected function getHelp(): string
    {
        $helper = new Helper();
        return $helper->getHelp();
    }
}