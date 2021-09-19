<?php

class Config
{
    protected $configs = [];

    public function __construct()
    {
        $this->getConfigs();
    }

    protected function getConfigs()
    {
        $filePath = "./config/config.json";

        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            $data = json_decode($data, true);

        }

    }
}