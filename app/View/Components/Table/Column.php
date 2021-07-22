<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Column extends Component
{
    /**
     * The table column type.
     *
     * @var string
     */
    public $type = 'text';
    
    /**
     * The record id.
     *
     * @var int
     */
    public $id;

    /**
     * The table column cell value.
     *
     * @var mixed
     */
    public $value;

    /**
     * The record action options to edit.
     *
     * @var array
     */
    public $edit;

    /**
     * The record action options to destroy.
     *
     * @var array
     */
    public $delete;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $type, int $id, $value = null, $edit = [], $delete = [])
    {
        $this->type = (string) $type; 
        $this->id = $id; 
        $this->value = $value; 
        $this->edit = $edit; 
        $this->delete = $delete; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.column');
    }
}
