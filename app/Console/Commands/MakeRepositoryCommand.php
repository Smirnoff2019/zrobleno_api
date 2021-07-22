<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Console\Templates\GeneratorByStubCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\TableSeparator;

class MakeRepositoryCommand extends GeneratorByStubCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository 
                                {name : Repository name}
                                {--t|type=true : Indicates whether to add the type to the name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'repository.stub';

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
     * This method will be executed immediately when the command method handler is called
     *
     * @return void
     */
    protected function boot()
    {
        parent::boot();

        $name = $this->getNameInput();

        $this->makeRepositoryInterface($name);
    }

    /**
     * Create a repository interface using the artisan command call
     *
     * @param string  $name
     */
    protected function makeRepositoryInterface(string $name)
    {
        return $this->call('make:repository-interface', [
            'name' => $this->getRepositoryInterfaceName($name),
        ]);
    }

    /**
     * Get a repository interface name.
     *
     * @param string  $name
     */
    protected function getRepositoryInterfaceName(string $name)
    {
        $name = Str::of($name)->replace('\\', '/');
        $type = $this->getType();
        if($name->endsWith($type)) {
            $name = $name->beforeLast($type);
        }

        return $name;
    }

    /**
     * Get a repository interface namespace.
     *
     * @param string  $name
     */
    protected function getRepositoryInterfaceNamespace(string $name)
    {   
        $name = $this->getRepositoryInterfaceName($name)->replace('/', '\\');
        $curentDirname = Str::of('Interfaces');

        if(!$name->contains($curentDirname->start('\\'))) {
            $name = $name->replaceLast(
                '\\',
                $curentDirname
                    ->start('\\')
                    ->finish('\\')
            );
        }

        return $name->finish('RepositoryInterface');
    }

    /**
     * Get a repository interface class name.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getClassName($namespace)
    {
        $_namespace = Str::finish($this->getNamespace($namespace), '\\');

        return (string) Str::of($namespace)->replace(
            [$_namespace],
            ['']
        );
    }

    /**
     * Get a repository interface class namespace.
     *
     * @param  string  $namespace
     * @return string  
     */
    protected function getClassNamespace($namespace)
    {
        return $this->getNamespace($namespace);
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

        $this->replaceClassName($stub, $namespace);
        $this->replaceNamespace($stub, $namespace);
        $this->replaceInterfaceNamespace($stub, $namespace);
        $this->replaceInterfaceName($stub, $namespace);
        
        return $stub;
    }

    /**
     * Replace the interface name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $namespace
     * @return string
     */
    protected function replaceClassName(&$stub, $namespace)
    {
        return $stub = str_replace(
            ['DummyClassName'],
            $this->getClassName($namespace),
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
    protected function replaceNamespace(&$stub, $namespace)
    {
        return $stub = str_replace(
            ['DummyNamespace'],
            $this->getClassNamespace($namespace),
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
    protected function replaceInterfaceName(&$stub, $namespace)
    {
        $name = $this->getRepositoryInterfaceNamespace($namespace)
            ->replace('\\', '/')
            ->basename();

        return $stub = str_replace(
            ['DummyClassInterfaceName'],
            $name,
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
        $namespace = $this->getRepositoryInterfaceNamespace($namespace);

        return $stub = str_replace(
            ['DummyClassInterfaceNamespace'],
            $namespace,
            $stub
        );
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
                ["Namespace", $this->getClassNamespace($namespace), '<info>created</info>'],
                ["Class Name", $this->getClassName($namespace), '<info>created</info>'],
            ],
        );
    }

}
