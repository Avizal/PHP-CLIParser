<?php

namespace App\Classes;

class Settings
{
    protected $fileSettings = "settings.json";
    protected $settings = [];

    public function __construct()
    {
        $this->getSettings();
    }

    protected function getSettings()
    {
        $filePath = PATH_CONFIG_DIR . "/" . $this->fileSettings;

        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            $data = json_decode($data, true);

            foreach ($data as $param => $item) {
                if (is_string($item)) {
                    $this->setSetting($param, $item);
                } elseif (is_array($item)) {
                    // Todo: Добавить взаимодействие с массивами
                    $this->setSetting($param, $item);
                }
            }
        }

    }

    public function setSetting(string $key, $value)
    {
        $this->settings[$key] = $value;
    }

    public function getSetting(string $key)
    {
        return $this->settings[$key] ?? false;
    }

    public function getArraySettings(): array
    {
        return $this->settings;
    }
}