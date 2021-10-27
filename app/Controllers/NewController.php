<?php

namespace app\Controllers;

class NewController
{
    public function index($arg)
    {
        echo 'NewController' . PHP_EOL;
        foreach ($arg as $key => $value)
        {
            echo $key . " : " . $value . PHP_EOL;
        }
    }
}