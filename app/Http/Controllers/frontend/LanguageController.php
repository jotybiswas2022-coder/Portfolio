<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        if (!in_array($locale, ['en', 'bn'])) {
            $locale = 'en';
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    }
}
