@switch($type)
    
    @case('image')
        <x-input-image
            label="{{ $label ?? '' }}"
            name="{{ $name ?? '' }}"
            value="{{ $value ?? '' }}"
            url="{{ $url ?? '' }}"
            mode="single"
            {{-- targetModalName="modal-galery-for-meta" --}}
            modal="modal-galery-for-meta"
        >
        </x-input-image>
        @break
    
    @case('text')
        <x-input
            type="text"
            label="{{ $label ?? '' }}"
            name="{{ $name ?? '' }}"
            value="{{ $value ?? '' }}"
            placeholder="{{ $placeholder ?? '' }}"
        >
        </x-input>
        @break

    @default
        
@endswitch