<?php

namespace FaarenTech\LaravelCustomUuids\Console\Commands;

use Illuminate\Console\Command;

class PublishStubsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-uuids:publish-stubs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes stubs for model and migration creation.';

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
        $this->publishStubs();

        return 0;
    }

    protected function publishStubs(): void
    {
        $this->info("Publishing stubs for model und migration creation");

        $packagePath = base_path('vendor/faaren-tech/laravel-custom-uuids/stubs/');
        $appPath = base_path('stubs/');

        if(!is_dir($appPath)) {
            mkdir($appPath);
        }

        $packageStubs = array_diff(
            scandir(
                $packagePath
            ),
            ["..", "."]
        );

        foreach ($packageStubs as $packageStub) {
            copy(
                $packagePath . $packageStub,
                $appPath . $packageStub
            );
        }

        $this->info("Stubs published to {$appPath}");
    }
}
