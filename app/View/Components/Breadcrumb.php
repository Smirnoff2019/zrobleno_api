<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * The component items array
     *
     * @var array
     */
    public $list;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $list = [])
    {
        $this->list = $list;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
