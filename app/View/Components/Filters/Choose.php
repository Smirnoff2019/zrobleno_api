<?php

namespace App\View\Components\Filters;

use Illuminate\View\Component;

class Choose extends Component
{
    /**
     * The select value.
     *
     * @var string
     */
    public $value;

    /**
     * The select label.
     *
     * @var string
     */
    public $label;

    /**
     * The select default option name.
     *
     * @var string
     */
    public $default;

    /**
     * The select options.
     *
     * @var string
     */
    public $options;

    /**
     * The select name.
     *
     * @var string
     */
    public $name = 'choose[]';

    /**
     * The select attribute id.
     *
     * @var string
     */
    public $attrId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $value   = null,
        string $label   = null,
        string $default = null,
        array  $options = [],
        string $name    = null,
        string $attrId  = null
    )
    {
        $this->value = $value;
        $this->label = $label ?: 'Сортировать';
        $this->default = $default ?: 'Выбрать...';
        $this->options = $options;
        $name && $this->name = $name;
        $this->attrId = $attrId ?: 'filters-choose-field-'.time();
    }
    
    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelected($value)
    {
        return $value == $this->value;
    }
    
    /**
     * Determine if the given option is the current selected option.
     *
     * @param  string  $option
     * @return bool
     */
    public function isSelectedDefault()
    {
        return (bool) !$this->value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.filters.choose');
    }
}
