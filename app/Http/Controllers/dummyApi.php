<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyApi extends Controller
{
    function getData()
    {
        return ["name","email" => "jamesParker","jamesParker@gmail.com"];
    }
}
