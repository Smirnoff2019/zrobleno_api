<?php

namespace App\Console;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractMakeStubCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new...";

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = '';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'fileName.stub';

    /**
     * Template stub class name to be replaced.
     *
     * @var string
     */
    protected $stubClassName = 'DummyClassName';

    /**
     * Default dirname.
     *
     * @var string
     */
    protected $defaultDirname = '';

    /**
     * Indicates whether to add the type to the name.
     *
     * @var bool
     */
    protected $addTypeIndex = false;

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $namespace)
    {
        $stub = parent::replaceClass($stub, $namespace);

        $name = str_replace('\\', '/', $namespace);
        $className = Arr::last(explode('/', $name));

        $this->table(
            ['Key', 'Value'],
            [
                ["ClassName", $className],
                ["Namespace", $namespace],
            ]
        );

        return str_replace($this->stubClassName, $className, $stub);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path("stubs/{$this->stubFileName}");
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return implode('\\', [
            $rootNamespace,
            $this->defaultDirname
        ]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {   
        $type = strtolower($this->type);

        return [
            ['name', InputArgument::REQUIRED, "The name of the {$type}."],
        ];
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        $name = trim($this->argument('name'));

        if (!$this->addTypeIndex) 
            return $name;

        if (Str::endsWith($name, $this->type)) 
            return $name;

        return Str::finish($name, $this->type);
    }
}
