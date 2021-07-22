<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{   
    /**
     * The menu sections
     *
     * @var array
     */
    public $sections;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($menu)
    {
        $this->sections = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu');
    }
}
