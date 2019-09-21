<?php

namespace Nojiri1098\LaravelMultiAuth\Console\Commands;

use Illuminate\Console\Command;
use Nojiri1098\LaravelMultiAuth\MultiAuth;
use Carbon\Carbon;

class MakeMultiAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:multiauth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic Multi-Auth views and routes.';

    protected $prefix = 'admin';

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
     * @return mixed
     */
    public function handle()
    {
        $files = [
            'Model.stub' => app_path('Admin.php'),
            'Migration.stub' => database_path('migrations/' . Carbon::now()->format('Y_m_d_His') . '_create_admins_table.php')
        ];

        foreach ($files as $src => $dist) {
            copy(__DIR__."/../stubs/$src", $dist);
        }
    }
}
