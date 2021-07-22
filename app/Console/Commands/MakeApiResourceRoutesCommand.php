<?php

namespace App\Console\Commands;

use App\Support\Str\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use App\Console\AbstractMakeStubCommand;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeApiResourceRoutesCommand extends GeneratorCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apiroutes 
                        {name} 
                        {controller?} 
                        {--t|type=true : Indicates whether to add the type to the name}';
                        
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new api resource rotes file";

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Api Resource Route';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'route.resource.api.stub';

    /**
     * Default argument {controller} value.
     *
     * @var string
     */
    protected $defaultControllerName = 'FooController';

    /**
     * Default dirname.
     *
     * @var string
     */
    protected $defaultDirname = 'routes/Api';

    /**
     * Indicates whether to add the type to the name.
     *
     * @var bool
     */
    protected $addTypeIndex = false;

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct($files);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'Resource api route file name'],
            ['controller', InputArgument::OPTIONAL, 'Resource api controller'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $this->addTypeIndex = trim($this->option('type')) === 'true';

        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $namespace = $this->qualifyClass($this->getNameInput());     // routes\Api\Foo\Bar
        $path = $this->getPath($namespace);                          // C:\OpenServer\Projects\zrobleno\api\routes/Api//Foo\Bar.php

        // Next, We will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildFile($namespace)));

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, "\\/");

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name
        );
    }

    /**
     * Build the routes file with the given name.
     *
     * @param  string  $namespace
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildFile($namespace)
    {
        $stub = $this->files->get($this->getStub());
        $controllerName = $this->getControllerNameInput();

        $this->replaceName($stub, $namespace);
        $this->replaceControllerName($stub, $controllerName);

        return $stub;
    }

    /**
     * Replace the name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $namespace
     * @return string
     */
    protected function replaceName(&$stub, $namespace)
    {
        $this->info("\nName: $namespace");
       
        $name = (string) Str::of($namespace)->replace(
            [
                "{$this->getNamespace($namespace)}\\",
                'Routes'
            ],
            ['']
        );

        return $stub = str_replace(
            ['{name}'],
            $name, 
            $stub
        );
    }

    /**
     * Replace the Controller Class Name for the given stub.
     *
     * @param  string  &$stub
     * @param  string  $controllerName
     * @return string  
     */
    protected function replaceControllerName(&$stub, $controllerName)
    {
        $controllerName = (string) Str::of($controllerName)->trim();
        
        $defInfo = $controllerName === trim($this->defaultControllerName) 
            ? '[default]' 
            : $controllerName; 
        $this->info("Controller: $defInfo \n");

        return $stub = str_replace(
            [
                $this->defaultControllerName
            ],
            $controllerName, 
            $stub
        );
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
     * Get the destination class path.
     *
     * @param  string  $namespace
     * @return string
     */
    protected function getPath($namespace)
    {
        $basePath = base_path($this->defaultDirname);
        $name = Str::of($namespace)
            ->replaceFirst($this->rootNamespace(), '')
            ->trim('\\')
            ->start('/')
            ->replace('\\', '/');

        return "{$basePath}{$name}.php";
    }

    /**
     * Get the resource api URI name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return (string) Str::of($this->argument('name'))
            ->trim()
            ->finish($this->addTypeIndex ? 'Routes' : '');
    }

    /**
     * Get the resource api controller class name from the input.
     *
     * @return string
     */
    protected function getControllerNameInput()
    {
        return trim($this->argument('controller') ?? $this->defaultControllerName);
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {   
        return (string) Str::of($this->defaultDirname)->replace('/','\\');
    }

}
