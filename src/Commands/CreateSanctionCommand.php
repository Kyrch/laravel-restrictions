<?php

declare(strict_types=1);

namespace Kyrch\Prohibition\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class CreateSanctionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prohibition:create-sanction
        {name : The name of the sanction}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new sanction';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Config::string('prohibition.models.sanction')::findOrCreate($this->argument('name'));
    }
}
