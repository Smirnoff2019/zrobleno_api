<?php

namespace App\View\Components\Table\ColumnType;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Action extends Component
{
    /**
     * The record id.
     *
     * @var int
     */
    public $id;

    /**
     * The table column cell label.
     *
     * @var mixed
     */
    public $label;

    /**
     * The table column cell before label.
     *
     * @var mixed
     */
    public $labelBefore = '';

    /**
     * The option record edit route.
     *
     * @var string
     */
    public $editRoute;

    /**
     * The option record destroy route.
     *
     * @var string
     */
    public $destroyRoute;

    /**
     * The option record edit url.
     *
     * @var string
     */
    public $editUrl = null;

    /**
     * The option record destroy url.
     *
     * @var string
     */
    public $destroyUrl = null;

    /**
     * The level.
     *
     * @var string
     */
    public $level = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = null, string $label = null, string $editRoute = null, string $destroyRoute = null, $level = 0)
    { 
        $this->id           = $id;
        $this->label        = $label;
        $this->level        = (int) $level;
        $this->editRoute    = $editRoute;
        $this->destroyRoute = $destroyRoute;
        $this->editUrl      = $id && $editRoute ? route($editRoute, $id) : null;
        $this->destroyUrl   = $id && $destroyRoute ? route($destroyRoute, $id) : null;

        if($level >= 1) {
            $this->labelBefore = (string) Str::padLeft("", intval($level) * 3, '-- ');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.column-type.action');
    }
}
