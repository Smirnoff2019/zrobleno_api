<?php

namespace App\View\Components\Table\ColumnType;

use Illuminate\View\Component;

class Image extends Component
{
    /**
     * The image url.
     *
     * @var string
     */
    public $url;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $url = '')
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.column-type.image');
    }
}
