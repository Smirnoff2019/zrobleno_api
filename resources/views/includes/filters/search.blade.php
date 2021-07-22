<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-auto">
    <div class="ml-auto d-flex mb-3 filter-search">
        <input 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name ?? $name = 'name' }}" 
            value="{{ $request->get($name) }}" 
            class="form-control mr-2 border-silver rounded-0" 
            placeholder="{{ $placeholder ?? 'Знайти...' }}" 
        >
        <div class="rounded-sm">
            <button class="rounded-sm btn btn-default font-w-500 px-3">Пошук</button>
        </div>
    </div>
</div>
