<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Console\Templates\GeneratorByStubCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryInterfaceCommand extends GeneratorByStubCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-interface 
                                {name : Repository interface name}
                                {--t|type=true : Indicates whether to add the type to the name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new repository interface";

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository Interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'repository-interface.stub';

    /**
     * Default dirname.
     *
     * @var string
     */
    protected $defaultDirname = 'App/Repositories';

    /**
     * Indicates whether to add the type to the name.
     *
     * @var bool
     */
    protected $addTypeIndex = true;

    /**
     * Curent interface dirname.
     *
     * @var string
     */
    protected $curentDirname = 'Interfaces';

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

        return $stub;
    }

    /**
     * Get a repository interface name.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getInterfaceName($namespace)
    {
        return (string) Str::of($namespace)->replace(
            Str::finish($this->getNamespace($namespace), '\\'),
            ''
        );
    }

    /**
     * Get a repository interface namespace.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getInterfaceNamespace($namespace)
    {
        return $this->getNamespace($namespace);
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
            ['DummyNamespace'],
            $this->getInterfaceNamespace($namespace),
            $stub
        );
    }

    /**
     * Formats the original atribute 'name' from the input and returns the final result
     *
     * @param  string  $name
     * @return string
     */
    protected function formatedNameInput(string $name)
    {
        $name = Str::of($name);
        $curentDirname = Str::of($this->curentDirname);

        if(!$name->contains($curentDirname->start('/'))) {
            $name = $name->replaceLast(
                '/',
                $curentDirname
                    ->start('/')
                    ->finish('/')
            );
        }
        return (string) $name;
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
            ['Key', 'Value', 'Status'],
            [
                ["Namespace", $this->getInterfaceNamespace($namespace), '<info>created</info>'],
                ["Interface Name", $this->getInterfaceName($namespace), '<info>created</info>'],
            ],
        );
    }

}
