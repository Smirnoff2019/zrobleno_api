<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectOption extends Component
{
    /**
     * The component label.
     *
     * @var string
     */
    public $label;
    
    /**
     * The component value.
     *
     * @var string|mixed
     */
    public $value;
    
    /**
     * The component state.
     *
     * @var bool
     */
    public $selected = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label = null, $value = null, bool $selected = false)
    {
        $this->label = $label;
        $this->value = $value;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select-option');
    }
}
