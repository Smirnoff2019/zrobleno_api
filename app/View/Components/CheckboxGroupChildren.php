<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroupChildren extends Component
{
    /**
     * The component label
     *
     * @var string
     */
    public $labelIn;

    /**
     * The component value
     *
     * @var string
     */
    public $valueIn = null;

    /**
     * The component checked
     *
     * @var mixed
     */
    public $masterValue = false;

    /**
     * The component records
     *
     * @var array
     */
    public $options = [];

    /**
     * The component children
     *
     * @var string
     */
    public $childrenIn = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options = [], $labelIn = null, $valueIn = null, $masterValue = null, $childrenIn = null)
    {
        // $this->name = $name;
        $this->options = $options;
        $this->labelIn = $labelIn;
        $this->valueIn = $valueIn;
        $this->masterValue = $masterValue;
        $this->childrenIn = $childrenIn;
    }

    public function getLabel($checkbox) {
        return $checkbox->{$this->labelIn} ?? null;
    }

    public function getValue($checkbox) {
        return $checkbox->{$this->valueIn} ?? null;
    }

    public function getChildren($checkbox) {
        return $checkbox->{$this->childrenIn} ?? null;
    }

    public function isChecked($checkbox) {
        return $this->masterValue->contains($this->valueIn, $checkbox->{$this->valueIn} ?? null);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.checkbox-group-children');
    }
}
