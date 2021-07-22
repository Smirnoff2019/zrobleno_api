<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoriesGroup extends Component
{
    /**
     * The component label
     *
     * @var string
     */
    public $label = 'Категории';

    /**
     * The component input name attr value
     *
     * @var string
     */
    public $name = 'categories[]';

    /**
     * The categories list
     *
     * @var array|[:Model]
     */
    public $categories;

    /**
     * The parent categories list
     *
     * @var array|[:Model]
     */
    public $parentCategories;

    /**
     * The checked categories list
     *
     * @var array|[:Model]
     */
    public $activeCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $label = null, $categories, $activeCategories, string $name = null)
    {
        $label && $this->label = $label;
        $name && $this->name = $name;

        $categoriesGroups = $categories->groupBy('parent_id');

        $this->activeCategories = $activeCategories ?? collect();

        $categoriesGroups = collect($categories)->map(function($cat) use($categoriesGroups) {
            $cat->children = $categoriesGroups[$cat->id] ?? $cat->children;
            $cat->checked = $this->isChecked($cat->id) ?? false;
            return $cat;
        })->groupBy('parent_id');

        $this->categories = $categoriesGroups[''];
    }
    
    /**
     * Get checked state status
     *
     * @return bool
     */
    public function isChecked($id)
    {
        return (bool) $this->activeCategories->where('id', $id)->first();
    }
    
    /**
     * Check does categories have children
     *
     * @return bool
     */
    public function hasChildren($id)
    {
        return (bool) ($this->categories[$id] ?? false);
    }
    
    /**
     * Get categories children
     *
     * @return array
     */
    public function getChildren($id)
    {
        return $this->categories[$id] ?? [];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.categories-group');
    }
}
