<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class Gallery extends Component
{
    /**
     * The modal name.
     *
     * @var array
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name = 'modalGallery')
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modals.gallery');
    }
}
