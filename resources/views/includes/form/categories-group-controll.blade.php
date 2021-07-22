<li class="mb-1">
    <input 
        type="checkbox" 
        class="custom-control-input" 
        id="{{ $attrId = "customCheckbox-".rand(1, 999999)}}"  
        value="{{ $category->id }}" 
        @if($category->checked ?? false) checked="checked" @endif 
        name="categories[]">
    <label 
        class="custom-control-label" 
        for="{{ $attrId }}">
        {{ $category->name }}
    </label>
    
    @if($category->children->isNotEmpty())
    <ul class="custom-control custom-checkbox my-2">
        @each('includes.form.categories-group-controll', $category->children, 'categories')
    </ul>
    @endif
</li>