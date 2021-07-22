<div class="col-12 col-sm-4 col-md-3 col-lg-auto">
    <div class="form-group mb-3">
        <select 
            class="form-control border-silver rounded-0" 
            name="{{ $name ?: '' }}" 
            id="filter_{{ $name }}"
        >
            <option value="{{ $default ?? null }}" >{{ $label ?? 'Обрати' }}</option>
            @forelse ($keys ?? [] as $value => $keyName)
                <option value="{{ $value }}" @selected($request->get($name) == $value) >{{ $keyName }}</option>
            @empty

            @endforelse
            @forelse ($groups ?? [] as $groupName => $items)
                <optgroup label="{{ $groupName }}">
                    @forelse ($items as $value => $keyName)
                        <option value="{{ $value }}" @selected($request->get($name) == $value) >{{ $keyName }}</option>
                    @empty
                    
                    @endforelse
                </optgroup>
            @empty
                                
            @endforelse
        </select>
    </div>
</div>
