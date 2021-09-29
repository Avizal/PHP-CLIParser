<?php

class Arguments
{
    protected $fileStartup = "";
    protected $arguments = [];
    protected $countArgs = 0;

    public function __construct($args = [])
    {
        $countArgs = func_num_args();
        $arguments = func_get_args();

        if (!empty($arguments)) {
            $arguments = array_shift($arguments);
            $countArgs = count($arguments);
        }

        // Получаем имя исполняемого файла, обычно это "index.php". И, удаляем аргумент из массива.
        if ($countArgs > 0) {
            if (!empty($arguments[0])) {
                $this->fileStartup = $arguments[0];
                array_shift($arguments);
                $countArgs--;
            }
        }

        // Если в массиве еще есть аргументы, то обработаем их.
        if ($countArgs > 0) {
            $attr = null;
            $value = null;

            foreach ($arguments as $argument) {
                if (strpos($argument, '-') === 0) {
                    $attr = ltrim($argument, '-');
                    continue;
                }

                if ($attr !== null) {
                    $value = $argument;
                }

                if (!empty($attr) && !empty($value)) {
                    $this->setArgument($attr, $value);

                    $attr = null;
                    $value = null;

                    continue;
                }
            }

            $this->updateCountArgument();
        }
    }

    public function getArgument($attr)
    {
        return $this->arguments[$attr] ?? null;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getCount(): int
    {
        return $this->countArgs;
    }

    protected function setArgument($attr, $value): bool
    {
        if (!is_string($attr) && !is_numeric($attr)) {
            return false;
        }

        $this->arguments[$attr] = $value;

        return true;
    }

    protected function updateCountArgument()
    {
        $this->countArgs = count($this->arguments);
    }

    public function isExist($attr): bool
    {
        if (isset($this->arguments[$attr])) {
            return true;
        } else {
            return false;
        }
    }

    public function isEmpty($attr): bool
    {
        if (empty($this->arguments[$attr])) {
            return true;
        } else {
            return false;
        }
    }
}