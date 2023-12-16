<?php

namespace Centrust\NovaLocalization\Http;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{


    public function changeLanguage(Request $request)
    {
        $User = \App\Models\User::find(auth()->id());

        $User->update( ['locale' => $request->language]);

        return redirect()->to(config('app.url').config('nova.path'));

    }
}
