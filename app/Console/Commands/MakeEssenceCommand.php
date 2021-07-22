<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class MakeEssenceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:essence
                                {modelName : The name of the model to be created} 
                                {tableName : The name of the table to be created}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates directories and migrations for the specified entity (model), directories and model for the specified name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getDefaultMigrationsPath()
    {
        return database_path('migrations');
    }

    public function makeModel(string $modelName)
    {
        return $this->call('make:model', [
            'name' => "Models/$modelName/$modelName",
        ]);
    }

    public function makeScheme(string $modelName, string $tableName)
    {
        return $this->call('make:schema', [
            'name' => "$modelName/{$modelName}Schema",
            'table' => "$tableName",
        ]);
    }

    public function makeDirDesciptions($modelName, $tableName, $defaultMigrationsPath)
    {
        return [
            [
                'name' => $modelName,
                'dir' => "$modelName",
                'echoDir' => "migrations\\$modelName",
                'command' => null,
                'path' => $modelPath = "$defaultMigrationsPath\\$modelName",
                'result' => false,
            ],
            [
                'name' => "   Tables",
                'dir' => $tablesDir = "$modelName\\Tables",
                'echoDir' => "migrations\\$modelName\\Tables",
                'command' => [
                    'make:migration',
                    [
                        'name' => "create_{$tableName}_table",
                        '--create' => $tableName,
                        '--path' => "database/migrations/$modelName/Tables"
                    ]
                ],
                'path' => "$defaultMigrationsPath\\$modelName\\Tables",
                'result' => false,
            ],
            [
                'name' => "   Relations",
                'dir' => $relationsDir = "$modelName\\Relations",
                'echoDir' => "migrations\\$modelName\\Relations",
                'command' => [
                    'make:migration',
                    [
                        'name' => "set_relations_for_{$tableName}_table",
                        '--table' => $tableName,
                        '--path' => "database/migrations/$modelName/Relations"
                    ]
                ],
                'path' => "$defaultMigrationsPath\\$modelName\\Relations",
                'result' => false,
            ],
            [
                'name' => "   Updates",
                'dir' => $updatesDir = "$modelName\\Updates",
                'echoDir' => "migrations\\$modelName\\Updates",
                'command' => [
                    'make:migration',
                    [
                        'name' => "update_{$tableName}_table",
                        '--table' => $tableName,
                        '--path' => "database/migrations/$modelName/Updates"
                    ]
                ],
                'path' => "$defaultMigrationsPath\\$modelName\\Updates",
                'result' => false,
            ],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $modelName = $this->argument('modelName');
        $tableName = $this->argument('tableName');
        $defaultMigrationsPath = $this->getDefaultMigrationsPath();

        $directories = $this->makeDirDesciptions($modelName, $tableName, $defaultMigrationsPath);
        $progressBar = $this->output->createProgressBar(count($directories));

        $this->info("\nCreate the necessary directories and migrations, please wait...");
        $progressBar->start();

        $directories = collect($directories)->map(function (array $item) use ($progressBar) {
            [
                'name' => $name,
                'dir' => $dir,
                'echoDir' => $echoDir,
                'command' => $command
            ] = $item;

            $resultMakeDir = Storage::disk('migrations')->makeDirectory($dir);

            if ($command) {
                Artisan::call(...$command);
            }

            $progressBar->advance();

            return [
                'name' => $name,
                'dir' => $echoDir,
                'resultMakeDir' => (bool) $resultMakeDir ? 'true' : 'false',
            ];
        });

        $progressBar->finish();
        $this->info("\n");

        $this->info("Migrations created successfully.");
        $this->table(
            ['Directories', 'Path', 'Result'],
            $directories
        );
        $this->info("\n");

        $resCode = $this->makeModel($modelName);

        $this->table(
            ['Model', 'Path'],
            [
                [
                    $modelName,
                    "app/Models/$modelName/$modelName.php"
                ]
            ]
        );
        $this->info("\n");

        $resCode = $this->makeScheme($modelName, $tableName);

        $this->table(
            ['Scheme', 'Path'],
            [
                [
                    "{$modelName}Schema.php",
                    "app/Schemes/$modelName/{$modelName}Schema.php"
                ]
            ]
        );

        $this->info("\nSuccessfully completed!");

        return 0;
    }
}
