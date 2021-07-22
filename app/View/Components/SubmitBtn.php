<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitBtn extends Component
{
    /**
     * The button label.
     *
     * @var string
     */
    public $label = "Сохранить";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label = null)
    {
        $label && $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.submit-btn');
    }
}
