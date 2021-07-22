@foreach($metaFields as $metaField)
    @php
        if($record) {
            $storage = $metaField->portfolioStorage()->where('metable_id', $record->id)->first();
        } else {
            $storage = null;
        }
        $value = $storage ? $storage->pivot->value : null;
    @endphp
    @switch((string) $metaField->type)
        
        @case("text")
            <x-input 
                type="text" 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("textarea")
            <x-textarea 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("number")
            <x-input 
                type="number" 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("email")
            <x-input 
                type="email" 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("url")
            <x-input 
                type="url" 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("password")
            <x-input 
                type="password" 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                placeholder='{{ "Введите ".(string) Str::lower($metaField->name) }}'
            />
            @break

        @case("select")
            <div class="form-group">
                <label for="">{{ $metaField->name }}</label>
                <select 
                    class="form-control" 
                    name="meta_fields[{{ $metaField->id }}]" 
                    value='{{ old("meta_fields[$metaField->id]") ?? $value }}' 
                    >
                    @forelse($metaField->options ?? [] as $val => $name)
                        <option value="{{ $val }}" @selected( (old("meta_fields[$metaField->id]") ?? $value) == $val )>{{ $name }}</option>
                    @empty
                        
                    @endforelse
                </select>
                <p class="form-text text-muted fs-2 ml-1 mt-2 mb-0">Laravel includes a variety of global "helper" PHP functions. Many of these functions are used by the framework itself; however, you are free to use them in your own applications if you find them convenient.</p>
                {{-- <small class="form-text ml-1 text-muted">Lofen lkald fwei{{ $metaField->description }}</small> --}}
            </div>
            @break

        @case("image")
            
            @inject('ImageModel', '\App\Models\Image\Image')
            @php
                $image = $ImageModel->find($value);
            @endphp
            <x-input-image 
                :label="$metaField->name" 
                name="meta_fields[{{ $metaField->id }}]" 
                mode="single" 
                :url="$image->url ?? ''"
                :value="$image->id ?? ''"
            />
            @break

        @case("images_gallery")
            @inject('ImageModel', '\App\Models\Image\Image')
            @php
                $images = $ImageModel->find(json_decode($value));
                $modal  = 'modal-galery-for-meta';
            @endphp
            <div class="form-group">
                <label for="">{{ $metaField->name }}</label>
                
                <table class="table table-bordered meta-field--images-gallery table-sortable reset-counter">
                    <thead>
                        <tr>
                            <td width="35"></td>
                            <td>
                                <h6 class="mb-0">{{ $metaField->name }}</h6>
                            </td>
                            <td width="35"></td>
                        </tr>
                    </thead>
                    <tbody class="">
                            
                        @forelse($images ?? [] as $image)
                            
                            <tr class="images-gallery-item bg-white">
                                <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--left-bar">
                                    <a role="button" class="iteration-counter border border-light mx-auto rounded-circle text-muted cursor-move ui-draggable-control" title="Переместить"></a>
                                </td>
                                <td class="images-gallery-item--body">
                                    <x-input-image 
                                        class="mb-0"
                                        name="meta_fields[{{ $metaField->id }}][]" 
                                        mode="single" 
                                        :url="$image->url ?? ''"
                                        :value="$image->id ?? ''"
                                        modal="{{ $modal }}"
                                    />
                                </td>
                                <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--right-bar">
                                    <span role="button" class="delete-image-from-gallery mx-auto" title="Удалить изображение"></span>
                                </td>
                            </tr>
                            
                        @empty

                            <tr class="images-gallery-item bg-white">
                                <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--left-bar">
                                    <a role="button" class="iteration-counter border border-light mx-auto rounded-circle text-muted cursor-move ui-draggable-control" title="Переместить"></a>
                                </td>
                                <td class="images-gallery-item--body">
                                    <x-input-image 
                                        class="mb-0"
                                        name="meta_fields[{{ $metaField->id }}][]" 
                                        mode="single" 
                                        modal="{{ $modal }}"
                                    />
                                </td>
                                <td scope="row" width="35" class="align-middle bg-light p-0 images-gallery-item--right-bar">
                                    <span role="button" class="delete-image-from-gallery mx-auto" title="Удалить изображение"></span>
                                </td>
                            </tr>

                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="bg-light images-gallery-empty d-none">
                            <td width="35"></td>
                            <td class="">
                                <p class="text-center mb-0">
                                    @include('includes.empty')
                                </p>
                            </td>
                            <td width="35"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="py-1">
                                <p class="text-right mb-0 my-1">
                                    <a href="{{ route('admin.api.meta-field.images-gallery.item') }}" data-name="meta_fields[{{ $metaField->id }}][]" data-modal="{{ $modal }}" type="button" class="btn btn-sm btn-outline-primary px-3 append-image-to-gallery">+ Додати зображення</a>
                                </p>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @push('modals')
                <x-modals.gallery 
                    :name="$modal"
                />  
            @endpush

            @break

        @case("group")
            <div class="form-group card ">

                <label class="card-header">
                    <h6 class="mb-0">{{ $metaField->name }}</h6>
                </label>
            
                <div class="meta-fields-group card-body py-2">
                    @isset($metaField->description)
                        <p class="card-text">{{ $metaField->description }}</p>
                    @endisset
                    @isset($metaField->children)
                        @include('includes.meta-field', ['metaFields' => $metaField->children->load('children'), 'record' => $record])
                    @endisset
                </div>
                
            </div>
            @break

        @default
            @break
            
    @endswitch
    
@endforeach
@php
    unset($metaFields);
@endphp