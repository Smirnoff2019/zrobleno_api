<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroup extends Component
{
    /**
     * The component label
     *
     * @var string
     */
    public $label;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.checkbox-group');
    }
}
