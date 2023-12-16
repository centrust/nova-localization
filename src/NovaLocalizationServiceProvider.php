<?php

namespace Centrust\NovaLocalization;

use Illuminate\Http\Request;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Centrust\NovaLocalization\Commands\NovaLocalizationCommand;
use Spatie\NovaTranslatable\Translatable;
class NovaLocalizationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('nova-localization')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_nova_localization_table')
            ->hasCommand(NovaLocalizationCommand::class);
    }

    public function bootingPackage()
    {
        Translatable::defaultLocales(['en', 'ar']);
        Nova::serving(function (ServingNova $event) {
            $Locale = auth()->user()?->locale ?? Null;
            if ($Locale) {
                app()->setLocale($Locale);
                $event->request->setLocale($Locale);
            }else{
                if(auth()->check()) {
                      auth()->user()->update(['locale' => app()->getLocale()]);
                }
            }
            if (app()->getLocale() == 'ar') {
                Nova::enableRTL();
            }
        });
        Nova::userMenu(function (Request $request, Menu $menu) {

            $language = app()->getLocale() == 'ar' ? 'en' : 'ar';

            $menu->prepend(MenuItem::externalLink(app()->getLocale() == 'ar' ? 'English' : 'عربي', '/change-language/' . $language));

            return $menu;
        });
    }
}
