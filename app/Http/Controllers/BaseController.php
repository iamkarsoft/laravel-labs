<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //

    public function trix(){
        return view('trix');
    }

    public function trixData(){
        dd(request()->all());
    }
}
