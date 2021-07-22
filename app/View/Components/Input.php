<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The input label.
     *
     * @var string
     */
    public $label;

    /**
     * The input type attribute.
     *
     * @var string
     */
    public $type;

    /**
     * The input name attribute.
     *
     * @var string
     */
    public $name;

    /**
     * The input value attribute.
     *
     * @var string
     */
    public $value;

    /**
     * The input placeholder attribute.
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type = 'text', string $label, string $name, string $value = null, string $placeholder = null)
    {   
        $this->type = $type;
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
