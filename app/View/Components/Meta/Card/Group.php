<?php

namespace App\View\Components\Meta\Card;

use App\Models\MetaField\GroupField;
use Illuminate\View\Component;

class Group extends Component
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
     * The alert message.
     *
     * @var string
     */
    public $type = GroupField::DEFAULT_SLUG;

    /**
     * The alert messages list.
     *
     * @var array
     */
    public $params = [
        'name',
        'slug',
        'type',
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
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    public function __construct($id = null, $name = null, $slug = null, bool $showParams = false, $parentId = '')
    {
        $pid = rand(10, time()/10000);
        
        $this->id = $id ?? $pid;
        $name && $this->name = $name;
        $slug && $this->slug = $slug;
        $this->showParams = (bool) $showParams;
        $this->parentId = (string) $parentId;

        $this->collapse = [
            'params' => [
                'target'     => "meta-{$this->id}--params-collapsed",
                'labelledby' => "meta-{$this->id}--params-collapsed-labelledby",
                'show'       => $this->showParams,
                'icon'       => 'fa-cogs'
            ],
            'children' => [
                'target'     => "meta-{$this->id}--children-collapsed",
                'labelledby' => "meta-{$this->id}--children-collapsed-labelledby",
                'show'       => false,
                'icon'       => 'fa-sort-amount-down-alt'
            ],
        ];

        $this->params = [
            'name' => [
                "id"          => "meta-{$this->id}--param-name",
                "title"       => '??????????',
                "description" => '???? ?????????? ???????????????????????????? ???? ???????????????? ??????????????????????',
                "name"        => "fields[{$this->id}][name]",
                "value"       => $this->name
            ],
            'slug' => [
                "id"          => "meta-{$this->id}--param-slug",
                "title"       => '??????????',
                "description" => '???????? ??????????, ?????? ????????????????. ???????????? ?????????????????????????????? ?????????? ????????????????????????.',
                "name"        => "fields[{$this->id}][slug]",
                "value"       => $this->slug
            ],
            'type' => [
                "id"          => "meta-{$this->id}--param-type",
                "title"       => '?????? ????????',
                "description" => '',
                "name"        => "fields[{$this->id}][type]",
                "value"       => $this->type
            ],
            'children' => [
                "id"          => "meta-{$this->id}--param-type",
                "title"       => '?????????????? ????????',
                "description" => '',
                "name"        => "fields[{$this->id}][type]",
                "value"       => $this->type
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
        return view('components.meta.card.group');
    }
}
