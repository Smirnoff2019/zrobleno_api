<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use App\Console\Templates\GeneratorByStubCommand;

class MakeModelSchemaCommand extends GeneratorByStubCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:schema 
                                {name : Mode schema interface name}
                                {table=table_name : The name of the table in DB}
                                {--t|type=true : Indicates whether to add the type to the name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new table (model) schema interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Schema';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'schema.stub';

    /**
     * Default dirname.
     *
     * @var string
     */
    protected $defaultDirname = 'App/Schemes';

    /**
     * Indicates whether to add the type to the name.
     *
     * @var bool
     */
    protected $addTypeIndex = true;

    /**
     * This method will be executed immediately when the command method handler is called
     *
     * @return void
     */
    protected function boot()
    {
        parent::boot();
    }

    /**
     * Build the routes file with the given name.
     *
     * @param  string  $namespace
     * @return string  $stub
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildFile($namespace): string
    {
        $this->info("\nMake {$this->type}:");

        $stub = $this->getStubContent();

        $this->replaceInterfaceNamespace($stub, $namespace);
        $this->replaceInterfaceName($stub, $namespace);
        $this->replaceDBTableName($stub, $namespace);

        return $stub;
    }

    /**
     * Replace the interface name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $namespace
     * @return string
     */
    protected function replaceInterfaceName(&$stub, $namespace)
    {   
        return $stub = str_replace(
            ['DummyInterfaceName'],
            $this->getInterfaceName($namespace),
            $stub
        );
    }

    /**
     * Replace the interface name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $namespace
     * @return string
     */
    protected function replaceInterfaceNamespace(&$stub, $namespace)
    {
        return $stub = str_replace(
            ['DummyInterfaceNamespace'],
            $this->getInterfaceNamespace($namespace),
            $stub
        );
    }

    /**
     * Replace the table name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $namespace
     * @return string
     */
    protected function replaceDBTableName(&$stub, $namespace)
    {
        return $stub = str_replace(
            ['table_name'],
            $this->getDBTableNameInput(),
            $stub
        );
    }

    /**
     * Get a model schema interface name.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getInterfaceName($namespace)
    {
        $_namespace = Str::of($this->getNamespace($namespace))->finish('\\');

        return (string) Str::of($namespace)->replace(
            $_namespace,
            ''
        );
    }

    /**
     * Get a model schema interface namespace.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getInterfaceNamespace($namespace)
    {
        return $this->getNamespace($namespace);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getDBTableNameInput()
    {
        return Str::of($this->argument('table') ?? 'table_name')
            ->trim()
            ->lower();
    }

    /**
     * Print information table.
     *
     * @param  string  $namespace
     * @return void
     */
    protected function showInfoTable($namespace)
    {
        $this->table(
            ['Key', 'Value'],
            [
                ["Namespace", $this->getInterfaceNamespace($namespace)],
                ["Class Name", $this->getInterfaceName($namespace)],
            ],
        );
    }

}
