<?php

namespace App\View\Components\Filters;

use Illuminate\View\Component;

class Search extends Component
{
    /**
     * The input value.
     *
     * @var string
     */
    public $value;

    /**
     * The input placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The input type.
     *
     * @var string
     */
    public $type = 'text';

    /**
     * The input name.
     *
     * @var string
     */
    public $name = 'search';

    /**
     * The input attribute id.
     *
     * @var string
     */
    public $attrId = 'filters-search-field';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $value       = null,
        string $placeholder = null,
        string $name        = null,
        string $type        = null,
        string $attrId      = null
    )
    {
        $this->value = $value;
        $this->placeholder = $placeholder ?: 'Искать...';
        $name && $this->name = $name;
        $type && $this->type = $type;
        $attrId && $this->attrId = $attrId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.filters.search');
    }
}
