<?php

namespace Kyrch\LaravelRestrictions\Commands;

use Illuminate\Console\Command;

class LaravelRestrictionsCommand extends Command
{
    public $signature = 'laravel-restrictions';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
