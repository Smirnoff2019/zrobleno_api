<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputImage extends Component
{
    /**
     * The input label.
     *
     * @var string
     */
    public $label;

    /**
     * The input value.
     *
     * @var mixed
     */
    public $value;

    /**
     * The input name attribute.
     *
     * @var string
     */
    public $name;

    /**
     * The image url.
     *
     * @var string
     */
    public $url;

    /**
     * The modal mode.
     *
     * @var string
     */
    public $mode;

    /**
     * The target modal name.
     *
     * @var string
     */
    public $targetModalName;

    /**
     * The storage input id attr value.
     *
     * @var string
     */
    public $inputId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label = null, $value = null, string $url = "", string $mode = "single", string $name = "image_id", string $modal = null)
    {
        $this->label = $label;
        $this->value = $value;
        $this->url = $url;
        $this->mode = $mode;
        $this->name = $name;
        $this->targetModalName = $modal ?? 'modal-gallery-'.rand(1, 999999);
        $this->inputId = 'storage-image-input-'.rand(1, 999999);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input-image');
    }
}
