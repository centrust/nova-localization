<?php

namespace Centrust\NovaLocalization;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Centrust\NovaLocalization\Commands\NovaLocalizationCommand;

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
}
