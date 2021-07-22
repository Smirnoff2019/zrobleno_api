<form action="{{ route('admin.images.update', $image) }}" method="POST">

    @csrf
    @method('PUT')

    <x-input 
        type="text" 
        label="Назва:" 
        name="title" 
        :value="old('title') ?? $image->file->title" 
        placeholder="Название..."
    />

    <x-textarea 
        label="Опис:" 
        name="description" 
        :value="old('description') ?? $image->file->description" 
        placeholder=""
    />

    <div class="form-group">
        <label for="image-url-inp">Ссылка:</label>
        <div class="input-group mb-3">
            <input 
                id="image-url-inp"
                type="text" 
                class="form-control" 
                value="{{ env('APP_URL') . (old('url') ?? $image->file->url) }}" 
                placeholder="{{ env('APP_URL') }}" 
                disabled
            >
            <div class="input-group-append">
                <a href="{{ env('APP_URL') . (old('url') ?? $image->file->url) }}" class="btn btn-outline-secondary" target="_blank" title="Открыть в новой вкладке">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <x-input 
        disabled
        type="text" 
        label="Файл:" 
        name="name" 
        :value="old('name') ?? $image->file->name" 
        placeholder="Название..."
    />

    <x-input 
        disabled
        type="text" 
        label="Рассположение:" 
        name="path" 
        :value="old('path') ?? $image->file->path" 
        placeholder="..."
    />

    {{-- Group --}}
    <x-select 
        label="Папка:" 
        name="images_group_id" 
        :value="old('images_group_id') ?? $image->images_group_id"
    >
        <option value="" readonly>Обрати</option>
        @foreach ($imagesGroups as $group)
            <option 
                value="{{ $group->id }}" 
                @selected( (old('images_group_id') ?? $image->images_group_id ?? null) == $group->id )
            >{{ $group->name }}</option>
        @endforeach
    </x-select>

    {{-- Status --}}
    <x-select 
        label="Статус:" 
        name="status_id" 
        :value="old('status_id') ?? $image->file->status_id"
    >
        @foreach ($statuses as $status)
            <option 
                value="{{ $status->id }}" 
                @selected( (old('status_id') ?? $record->status_id ?? null) == $status->id )
            >{{ $status->name }}</option>
        @endforeach
    </x-select>

    <div class="py-3 d-flex justify-content-end">
        <x-submit-btn/>
    </div>

</form>