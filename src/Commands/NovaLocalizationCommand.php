<?php

namespace Centrust\NovaLocalization\Commands;

use Illuminate\Console\Command;

class NovaLocalizationCommand extends Command
{
    public $signature = 'nova-localization';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
