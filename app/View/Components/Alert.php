<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type.
     *
     * @var string
     */
    public $type = 'success';

    /**
     * The alert message.
     *
     * @var array|string
     */
    public $message;

    /**
     * The alert messages list.
     *
     * @var array
     */
    public $asList = false;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct(string $type, $message = null, bool $strong = true)
    {
        $this->type = $type;
        $this->message = count($message = (array) $message) > 1 ? $message : head($message);
        $this->asList = is_array($this->message);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
