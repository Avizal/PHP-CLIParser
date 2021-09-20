<?php

class Arguments
{
    protected $arguments = [];
    protected $countArgs = 0;

    public function __construct($args = [])
    {
        $this->countArgs = func_num_args();
        $this->arguments = func_get_args();

//        if ($this->countArgs > 0) {
//            for ($i = 0; $i < $this->countArgs; $i++) {
//                //$arguments[] = func_get_arg();
//                $this->arguments[] = func_get_arg($i);
//            }
//        }


//        $foreach ($arguments as $argument) {
//            $this->arguments[] = $argument;
//        }
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getCount():int {
        return $this->countArgs;
    }
}