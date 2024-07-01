<?php

namespace App\Http\Controllers\lang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if(array_key_exists($lang,config('languages'))){
            Session::put('applocale',$lang);
        }
        return redirect()->back();
    }
}
