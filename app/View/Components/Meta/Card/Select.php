<?php

namespace App\View\Components\Meta\Card;

use App\Models\MetaField\SelectField;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * The meta field id.
     *
     * @var string
     */
    public $id = '';

    /**
     * The meta field card collapse groups.
     *
     * @var array
     */
    public $collapse = [];

    /**
     * The alert message.
     *
     * @var string
     */
    public $name = "(not label)";

    /**
     * The alert message.
     *
     * @var string
     */
    public $slug;

    /**
     * The options param value.
     *
     * @var string
     */
    public $options = '';

    /**
     * The alert message.
     *
     * @var string
     */
    public $type = SelectField::DEFAULT_SLUG;

    /**
     * The alert messages list.
     *
     * @var array
     */
    public $params = [
        'name',
        'slug',
        'type',
        'options',
    ];

    /**
     * The alert messages list.
     *
     * @var bool
     */
    public $showParams = false;

    /**
     * The alert messages list.
     *
     * @var bool
     */
    public $parentId = null;

    /**
     * Create the component instance.
     *
     * @param  string|null  $id
     * @param  string|null  $name
     * @param  string|null  $slug
     * @param  string|null  $options
     * @param  bool|null    $showParams
     * @param  string       $parentId
     * @return void
     */
    public function __construct($id = null, $name = null, $slug = null, $options = null, bool $showParams = false, $parentId = '')
    {
        $pid = rand(10, time());

        $this->id = $id ?? $pid;

        $name    && $this->name    = $name;
        $slug    && $this->slug    = $slug;
        $options && $this->options = $options;
        
        $this->showParams = (bool) $showParams;
        $this->parentId   = (string) $parentId;

        $this->collapse = [
            'params' => [
                'target'     => "meta-{$this->id}--params-collapsed",
                'labelledby' => "meta-{$this->id}--params-collapsed-labelledby",
                'show'       => $this->showParams,
                'icon'       => 'fa-cogs'
            ]
        ];

        $this->params = [
            'name' => [
                "id"          => "meta-{$this->id}--param-name",
                "title"       => 'Назва',
                "description" => 'Ця назва відображається на сторінці редагування',
                "placeholder" => 'Введіть назву',
                "name"        => "fields[{$this->id}][name]",
                "value"       => $this->name
            ],
            'slug' => [
                "id"          => "meta-{$this->id}--param-slug",
                "title"       => 'Ярлик',
                "description" => 'Одне слово, без пробілів. Можете використовувати нижнє підкреслення.',
                "placeholder" => 'Введіть ярлик',
                "name"        => "fields[{$this->id}][slug]",
                "value"       => $this->slug
            ],
            'type' => [
                "id"          => "meta-{$this->id}--param-type",
                "title"       => 'Тип поля',
                "description" => '',
                "name"        => "fields[{$this->id}][type]",
                "value"       => $this->type
            ],
            'options' => [
                "id"          => "meta-{$this->id}--param-options",
                "title"       => 'Варіанти вибору',
                "placeholder" => 'red : Червоний',
                // "description" => "У кожному рядку по варіанту.<br> Приклад:<br>&emsp;<b>red : Червоний</b><br>&emsp;<b>pink : Рожевий</b>",
                "description" => "У форматі JSON.<br> Приклад:<br>{<br>&emsp;<b>'red' : 'Червоний',</b><br>&emsp;<b>'pink' : 'Рожевий'</b><br>}",
                "name"        => "fields[{$this->id}][options]",
                "rows"        => 6,
                "value"       => json_encode($this->options)
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.meta.card.select');
    }
}
