<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Commands;

use Illuminate\Console\Command;

class CreateProhibitionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prohibition:create-prohibition
        {name : The name of the prohibition}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new prohibition';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        config('prohibition.models.prohibition')::findOrCreate($this->argument('name'));
    }
}
