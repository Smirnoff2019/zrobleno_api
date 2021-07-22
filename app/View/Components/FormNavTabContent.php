<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormNavTabContent extends Component
{
    /**
     * The component label
     *
     * @var string
     */
    public $label;

    /**
     * The component name
     *
     * @var string
     */
    public $name;

    /**
     * The component state
     *
     * @var string
     */
    public $state;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $active = false)
    {
        $this->name  = $name;
        $this->label = $label;
        $this->state = (bool) $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-nav-tab-content');
    }
}
