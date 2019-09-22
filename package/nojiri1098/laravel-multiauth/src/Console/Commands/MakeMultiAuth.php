<?php

namespace Nojiri1098\LaravelMultiAuth\Console\Commands;

use Illuminate\Console\Command;
use Nojiri1098\LaravelMultiAuth\MultiAuth;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

    protected $user_model_path;

    protected $redirectifauthenticated_middleware_path;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->user_model_path = app_path('User.php');
        $this->redirectifauthenticated_middleware_path = app_path('Http/Middleware/RedirectIfAuthenticated.php');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('make:adminlte');
        $this->call('vendor:publish', ['--provider' => 'JeroenNoten\LaravelAdminLte\ServiceProvider', '--tag' => 'assets']);
        
        $this->exportFiles();
        
        $lines = explode("\n", file_get_contents($this->user_model_path));

        foreach ($lines as $key => $line) {
            if (Str::startsWith($line, 'class')) {
                array_splice($lines, $key - 1, 0, "use App\Notifications\ResetPassword;");
                break;
            }
        }

        foreach ($lines as $key => $line) {
            if (Str::startsWith($line, '}')) {
                array_splice($lines, $key, 0,     "\n"                                                                );
                array_splice($lines, $key + 1, 0, "    public function sendPasswordResetNotification(\$token)"        );
                array_splice($lines, $key + 2, 0, "    {"                                                             );
                array_splice($lines, $key + 3, 0, "        \$this->notify(new ResetPassword(\$token, \$this->email));");
                array_splice($lines, $key + 4, 0, "    }"                                                             );
                break;
            }
        }
        
        file_put_contents($this->user_model_path, implode("\n", $lines));

        $lines = explode("\n", file_get_contents($this->redirectifauthenticated_middleware_path));
        foreach ($lines as $key => $line) {
            if (Str::contains($line, "return redirect('/home')")) {
                array_splice($lines, $key,     0, "            \$route = \$guard === 'admin' ? 'admin.home' : 'home';");
                array_splice($lines, $key + 1, 0, ""                                                                  );
                array_splice($lines, $key + 2, 0, "            return redirect()->route(\$route);"                    );
                array_splice($lines, $key + 3, 1);
                break; 
            }
        }
        file_put_contents($this->redirectifauthenticated_middleware_path, implode("\n", $lines));
        
        $this->info('Multi-Auth scaffolding generated successfully.');
    }

    protected function exportFiles()
    {
        $files = [
            'Model.stub' => app_path('Admin.php'),
            'Migration.stub' => database_path('migrations/'.Carbon::now()->format('Y_m_d_His').'_create_admins_table.php'),
            'auth.stub' => config_path('auth.php'),
        ];

        foreach ($files as $src => $dist) {
            copy(__DIR__."/../stubs/$src", $dist);
        }
    }
}
