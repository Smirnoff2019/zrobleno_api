<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Console\AbstractMakeStubCommand;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeTraitCommand extends AbstractMakeStubCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:trait';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $stubFileName = 'trait.stub';

    /**
     * Template stub class name to be replaced.
     *
     * @var string
     */
    protected $stubClassName = 'DummyTrait';

    /**
     * Default dirname.
     *
     * @var string
     */
    protected $defaultDirname = 'Traits';

    /**
     * Indicates whether to add the type to the name.
     *
     * @var bool
     */
    protected $addTypeIndex = true;

}
