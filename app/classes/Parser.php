<?php

namespace App\Classes\Parser;

abstract class Parser
{
    public function getRawData() {}
    public function saveData() {}

    public function __construction()
    {
        $this->getData();
    }

    protected function getData() {
        //TODO: какая-то логика проверки

        $this->getRawData();
        $this->saveData();
    }
}