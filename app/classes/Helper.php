<?php

namespace App\Classes;

class Helper
{
    protected $staticInfo = [
        '[command]' => 'Любая команда ниже',
        '--help' => 'Вывести на экран всю документацию',
        '--help [command]' => 'Вывести на экран информацию только по выбранной команде'
    ];

    protected $pattern = "Последовательность аргументов: index.php --[command] [value] --[command2] [value2]";

    public function getHelp(): string
    {
        return $this->infoToString();
    }

    protected function infoToString(): string
    {
        $result = "";

        if (!empty($this->pattern)) {
            $result .= $this->pattern . PHP_EOL . PHP_EOL;
        }

        if (!empty($this->staticInfo)) {
            foreach ($this->staticInfo as $command => $description) {
                $result .= $command . ' - ' . $description . ';' . PHP_EOL;
            }
        }

        return $result;
    }
}