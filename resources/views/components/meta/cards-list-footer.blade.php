@props([
    'label' => '+ Додати поле'
])
<li class="list-group-item ui-label-empty bg-light px-0 d-none">
    <div class="col-12">
        <p class="text-center text-monospace fs-2 mb-0">Empty list...</p>
    </div>
</li>
<li class="list-group-item meta-fields-schema-footer py-2 px-0">
    <div class="col-12">
        <div class="row mx-0 flex-row-reverse">
            <div class="">
                <a href="{{ route('admin.api.meta-field.generate') }}" role="button" class="btn btn-primary btn-sm pl-2 pr-3 add-new-meta-field-card">{{ $label }}</a>
            </div>
        </div>
    </div>
</li>