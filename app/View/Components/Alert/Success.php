<?php

namespace App\View\Components\Alert;

use Illuminate\View\Component;

class Success extends Component
{
    /**
     * The alert message
     *
     * @var string
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->message = 'Данные успешно сохранены!';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert.success');
    }
}
