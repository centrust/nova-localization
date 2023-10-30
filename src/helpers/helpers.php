<?php

use Centrust\NovaLocalization\TranslateTermTask;
use Illuminate\Support\Facades\Cache;

if (!function_exists('_tran')) {
    function _tran(string $term, $Locale = null)
    {
        try {
            if (config('nova-localization.localization_enable_cache')) {
                $Term = Cache::rememberForever('Translation.' . $term, fn() => app(TranslateTermTask::class)->run($term));
            } else {
                $Term = app(TranslateTermTask::class)->run($term);
            }
            if ($Term) {
                $Locale = $Locale ?? app()->getLocale();
                return $Locale == 'ar' ? $Term->ar ?? $term : $Term->en ?? $term;
            } else {
                return $term;
            }
        } catch (Exception $e) {
//            \Illuminate\Support\Facades\Log::error('Localization Helper :' . $e->getMessage());
            return $term;
        }
    }


}
