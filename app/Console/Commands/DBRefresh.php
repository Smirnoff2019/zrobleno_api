<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DBRefresh extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DB-refresh {--d|doNotRundumpAutoload} {--s|doNotRunSeeders}';

    /**
     * The console command task.
     *
     * @var string
     */
    protected $task = 'composer dumpautoload && php artisan migrate:fresh --seed && php artisan passport:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump autoload files, refresh DB migrations, make DB seeders and install api passport';

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
        $commandLine = implode(
            ' && ', 
            collect($cmar = [
                $this->option('doNotRundumpAutoload') ? null : 'composer dumpautoload',
                'php artisan migrate:fresh' . ($this->option('doNotRunSeeders') ? '' : ' --seed'),
                'php artisan passport:install'
            ])
                ->reject(function ($command) {
                    return empty($command);
                })
                ->toArray()
        );

        $this->info('Run command line:');
        $this->info($commandLine);

        $result = shell_exec($commandLine);
        $this->info($result);
    }

}
