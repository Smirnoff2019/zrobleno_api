<?php

namespace App\View\Components\Table\ColumnType;

use Illuminate\View\Component;

class Text extends Component
{
    /**
     * The instance value.
     *
     * @var string
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = '')
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.column-type.text');
    }
}
