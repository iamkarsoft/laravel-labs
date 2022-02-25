<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kudi;
class ConversionController extends Controller
{
    //

    public function index(){

        $convertFrom = Kudi::convertFrom('USD',1);
        $convertTo = Kudi::convertTo('EUR',1000);

        $result = [$convertFrom,$convertTo];

        return $result;


    }
}
