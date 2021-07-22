<?php

namespace App\View\Components\Table\ColumnType;

use Illuminate\View\Component;

class Status extends Component
{
    /**
     * The status model instance.
     *
     * @var string
     */
    public $status;
    
    /**
     * The status state.
     *
     * @var string
     */
    public $state = '';

    /**
     * The status name.
     *
     * @var string
     */
    public $label = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status = null)
    {
        $this->status = $status;
        $this->label = $status->name ?? '';

        switch ($status->type ?? '') {
            case 'active':
                $this->state = 'success';
                break;
            case 'confirmed':
                $this->state = 'success';
                break;
            case 'rejected':
                $this->state = 'success';
                break;
            case 'inactive':
                $this->state = 'secondary';
                break;
            case 'canceled':
                $this->state = 'secondary';
                break;
            case 'awaiting_confirmation':
                $this->state = 'warning';
                break;
            case 'recruitment_of_participants':
                $this->state = 'info';
                break;
            case 'on_designing':
                $this->state = 'primary';
                break;
            
            default:
                $this->state = 'primary';
                break;
        }
    }

    /**
     * Check is have status.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return (bool) !$this->label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.column-type.status');
    }
}
