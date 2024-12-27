<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class ExampleRequestController extends Controller
{
    public function show(Request $request)
    {
        $path = $request->path();
        echo '$request->path()  : ',$path,'<br>';
        $url = $request->url();
        echo '$request->url()   : ',$url,'<br>';

        print($request->fullUrlWithoutQuery(['type']));
        // echo $url;
    }
}
