<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The select label.
     *
     * @var string
     */
    public $label;

    /**
     * The select options list.
     *
     * @var array
     */
    public $options;

    /**
     * The select name attribute.
     *
     * @var string
     */
    public $name;

    /**
     * The select value attribute.
     *
     * @var string
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, $value = null, $options = [])
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->options = $options ?? [];
    }

    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($option)
    {
        return $option == $this->value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.select');
    }
}
