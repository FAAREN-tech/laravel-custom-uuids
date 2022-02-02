<?php

namespace FaarenTech\LaravelCustomUuids\Console\Commands;

use Illuminate\Console\Command;

class InstallUuidPackageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-uuids:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes the relevant steps to install this package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
