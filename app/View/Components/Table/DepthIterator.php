<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class DepthIterator extends Component
{
    /**
     * The items collection.
     *
     * @var array
     */
    public $records = [];
    
    /**
     * The parent item
     *
     * @var mixed
     */
    public $parent = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($records = [], $parent = null)
    {
        $this->records = $records;
        $this->parent = $parent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.depth-iterator');
    }
}
