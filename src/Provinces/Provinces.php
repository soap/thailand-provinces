<?php

namespace Soap\ThProvinces\Provinces;

use Illuminate\Support\Facades\Config;

class Provinces
{
    public function saySomething()
    {
        return 'Hello World!';
    }

    public function showTable()
    {
        return config('ThProvinces.provinces_table');
    }
}