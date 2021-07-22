<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * The checkbox label.
     *
     * @var string
     */
    public $label;

    /**
     * The checkbox name.
     *
     * @var string
     */
    public $name;

    /**
     * The checkbox state.
     *
     * @var bool
     */
    public $checked = false;

    /**
     * The checkbox attribute id.
     *
     * @var string
     */
    public $attrId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label, string $name, $checked = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->checked = $checked;
        $this->attrId = 'checkbox-'.rand(1, 999999);
    }

    /**
     * Get checked state status
     *
     * @return bool
     */
    public function isChecked()
    {
        return (bool) $this->checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
