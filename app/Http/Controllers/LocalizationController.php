<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function setLocale($lang)
    {
        if (in_array($lang, ['en', 'ar'])) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
    
        return redirect()->back(); // Redirect back to the previous page
    }
}