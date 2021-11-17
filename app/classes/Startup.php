<?php

use App\Classes\Arguments;

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






    protected $namespacesMap = array();

    public function addNamespace($namespace, $rootDir)
    {
        if (is_dir($rootDir)) {
            $this->namespacesMap[$namespace] = $rootDir;
            return true;
        }

        return false;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    protected function autoload($class)
    {
        $pathParts = explode('\\', $class);

        if (is_array($pathParts)) {
            $namespace = array_shift($pathParts);

            if (!empty($this->namespacesMap[$namespace])) {
                $filePath = $this->namespacesMap[$namespace] . '/' . implode('/', $pathParts) . '.php';
                require_once $filePath;
                return true;
            }
        }

        return false;
    }
}