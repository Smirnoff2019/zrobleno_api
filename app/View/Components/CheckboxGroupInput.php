<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroupInput extends Component
{
    /**
     * The component label
     *
     * @var string
     */
    public $label;

    /**
     * The component value
     *
     * @var string
     */
    public $value = null;

    /**
     * The component checked
     *
     * @var string
     */
    public $checked = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $value = null, $checked = false)
    {
        $this->label = $label;
        $this->value = $value;
        $this->checked = (bool) $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.checkbox-group-input');
    }
}
