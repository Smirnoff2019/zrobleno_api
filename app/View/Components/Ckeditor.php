<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Ckeditor extends Component
{
    /**
     * The textarea label.
     *
     * @var string
     */
    public $label;

    /**
     * The textarea name attribute.
     *
     * @var string
     */
    public $name;

    /**
     * The textarea value attribute.
     *
     * @var string
     */
    public $value;

    /**
     * The textarea placeholder attribute.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The textarea rows count attribute.
     *
     * @var int
     */
    public $rows = 8;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, string $value = null, string $placeholder = null, int $rows = 3)
    {   
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.ckeditor');
    }
}
