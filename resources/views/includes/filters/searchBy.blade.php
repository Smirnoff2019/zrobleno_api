<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-auto">
    <div class="ml-auto input-group d-flex flex-nowrap mb-3 filter-search-by">
        <div>
            <select 
                class="form-control border-silver border-right-0 rounded-0 w-auto" 
                name="{{ $name ?? $name = 'search_by' }}[name]"
                value="{{ $request->input("$name.name") }}" 
            >
                @forelse ($columns ?? [] as $value => $columnName)
                    <option value="{{ $value }}" @selected($request->input("$name.name") == $value) >{{ $columnName }}</option>
                @empty
                    <option value="{{ $default ?? null }}" readonly>{{ $label ?? 'Обрати' }}</option>
                @endforelse
            </select>
        </div>
        <input 
            list="{{ $datalistId = "search-datalist-".rand(10, 100) }}"
            type="{{ $type ?? 'text' }}" 
            name="{{ $name }}[value]"
            value="{{ $request->input("$name.value") }}" 
            class="form-control border-silver rounded-0" 
            placeholder="{{ $placeholder ?? 'Знайти...' }}" 
        >
        <datalist id="{{ $datalistId }}">
            @forelse ($datalist ?? [] as $value)
                <option value="{{ $value }}">
            @empty
            @endforelse
        </datalist>
        <div class="rounded-sm ml-2">
            <button class="rounded-sm btn btn-default font-w-500 px-3">Пошук</button>
        </div>
    </div>
</div>