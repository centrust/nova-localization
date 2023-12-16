<?php

namespace Centrust\NovaLocalization\Http;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocalizationController extends Controller
{


    public function changeLanguage(Request $request)
    {
        Log::info('LocalizationController:changeLanguage:User: '.$request->id.'  :locale:'.$request->language);

        $User = User::find($request->id);
        $User->update( ['locale' => $request->language]);

        return redirect()->to(config('app.url').config('nova.path'));

    }
}
