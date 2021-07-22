<div class="form-group">
    <label for="validationCustom05">{{ $label }}</label>
    <div class="bg-light border p-3 custom-cat-choise-field">
        
        @if($categories)
        <ul class="custom-control custom-checkbox mb-1">
            @each('includes.form.categories-group-controll', $categories, 'categories')
        </ul>
        @endif

        @unless($categories)
        <span class="text-muted">Not found any category...</span>
        @endunless

    </div>
</div>