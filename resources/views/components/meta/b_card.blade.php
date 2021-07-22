@props([
    'iteration'                      => $iteration = 1,
    'targetFieldsCollapse'           => "meta-fields-collapse-n".rand(10, 99999),
    'targetParamsFieldsCollapse'     => "meta-params-collapse-n".rand(10, 99999),
    'labelledbyFieldsCollapse'       => "meta-fields-collapse-n".rand(10, 99999)."-labelledby",
    'labelledbyParamsFieldsCollapse' => "meta-params-collapse-n".rand(10, 99999)."-labelledby",
    'paramFieldNameId'                 => "meta_field_n".$iteration."_name",
    'paramFieldSlugId'                 => "meta_field_n".$iteration."_slug",
    'name'                           => "Поле $iteration",
    'slug'                           => "meta_field_slug_n$iteration",
    'type'                           => "Текст",
])

{{-- meta-field-card --}}
<li class="meta-field-card list-group-item p-0">
    <div class="d-flex flex-column">

        {{-- meta-field-card-header --}}
        <div class="meta-field-card-header col-12">
            <div class="row mx-0 py-2">
                
                {{-- meta-field-card-header--iteration --}}
                {{-- meta-field-card-collapse--control --}}
                <div class="col my-1">
                    <div class="d-flex align-items-center">

                        <div class="meta-field-card-header--iteration border fs-2 mr-3">
                            {{ $iteration }}
                        </div>

                        {{-- meta-field-card-collapse--control --}}
                        <div class="btn-group-toggle mx-1" data-toggle="buttons">
                            <label 
                                id=""
                                class=" 
                                    meta-field-card-collapse--control 
                                    fs-2 mb-0 py-2
                                    collapsed 
                                    d-flex align-items-center justify-content-center 
                                    btn btn-sm btn-square btn-light 
                                    border
                                "
                                data-toggle="collapse" 
                                data-target="#{{ $targetParamsFieldsCollapse }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $targetParamsFieldsCollapse }}"
                            >
                                <input type="checkbox" hidden autocomplete="off">
                                <i class="fas fa-cogs"></i>
                            </label>
                        </div>

                        {{-- meta-field-card-collapse--control --}}
                        <div class="btn-group-toggle mx-1" data-toggle="buttons">
                            <label 
                                class=" 
                                    meta-field-card-collapse--control 
                                    fs-2 mb-0 py-2
                                    collapsed 
                                    d-flex align-items-center justify-content-center 
                                    btn btn-sm btn-square btn-light 
                                    border
                                "
                                data-toggle="collapse" 
                                data-target="#{{ $targetFieldsCollapse }}" 
                                aria-expanded="false" 
                                aria-controls="{{ $targetFieldsCollapse }}"
                            >
                                <input type="checkbox" hidden autocomplete="off">
                                <i class="fas fa-sort-amount-down-alt"></i> 
                            </label>
                        </div>

                    </div>
                </div>

                {{-- meta-field-card-header--action --}}
                {{-- >>   meta-field-card-header--name --}}
                <div class="col my-1">
                    <a 
                        class="meta-field-card-header--action nav-link text-primary p-0"
                        data-toggle="collapse" 
                        href="#{{ $targetParamsFieldsCollapse }}" 
                        role="button" 
                        aria-expanded="false" 
                        aria-controls="{{ $targetParamsFieldsCollapse }}"
                    >
                        <strong class="meta-field-card-header--name">{{ $name }}</strong>     
                    </a>
                </div>

                {{-- meta-field-card-header--slug --}}
                <div class="col my-1">
                    <p class="meta-field-card-header--slug mb-0">{{ $slug }}</p>
                </div>

                {{-- meta-field-card-header--type --}}
                <div class="col my-1">
                    <p class="meta-field-card-header--type mb-0">{{ $type }}</p>
                </div>

            </div>
        </div>

        {{-- meta-field-card-body --}}
        <div class="meta-field-card-body col-12 px-0">

            {{-- meta-field-card-body--params --}}
            <div 
                class="meta-field-card-body--params mb-0 collapse" 
                id="{{ $targetParamsFieldsCollapse }}" 
                aria-labelledby="{{ $labelledbyParamsFieldsCollapse }}"
            >
                <table class="table mb-0">
                    <tbody>
                        
                        <tr>
                            <td class="border-right bg-light" scope="row" width="300">
                                <label for="{{ $paramFieldNameId }}" class="mb-0">
                                    <strong>Назва</strong>
                                </label>
                                <p class="fs-2 mb-0 font-weight-light">Ця назва відображується на сторінці редагування</p>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input 
                                        id="{{ $paramFieldNameId }}" 
                                        type="text" 
                                        class="form-control text-black" 
                                        placeholder="Назва поля..."
                                        value="{{ $name }}"
                                    >
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="border-right bg-light" scope="row" width="400">
                                <label for="{{ $paramFieldSlugId }}" class="mb-0">
                                    <strong>Ярлик</strong>
                                </label>
                                <p class="fs-2 mb-0 font-weight-light">Одне слово, без пробілів. Можете використовувати нижнє підкреслення.</p>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input 
                                        id="{{ $paramFieldSlugId }}" 
                                        type="text" 
                                        class="form-control text-black" 
                                        placeholder="Ярлик поля..."
                                        value="{{ $slug }}"
                                    >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="border-right bg-light" scope="row" width="400">
                                <label for="{{ $paramFieldSlugId }}" class="mb-0">
                                    <strong>Тип</strong>
                                </label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select 
                                        id="{{ $paramFieldSlugId }}"
                                        class="form-control text-black" 
                                        value="{{ $type }}"
                                    >   
                                        <optgroup label="Загальне">
                                            <option value="text">Текст</option>
                                            <option value="textarea">Область тексту</option>
                                            <option value="number">Число</option>
                                            <option value="email">Email</option>
                                            <option value="url">Url</option>
                                            <option value="password">Пароль</option>
                                        </optgroup>
                                        <optgroup label="Вміст">
                                            <option value="image">Зображення</option>
                                            <option value="gallery">Галерея</option>
                                            <option value="wysiwyg">Візуальний редактор</option>
                                        </optgroup>
                                        <optgroup label="Вибір">
                                            <option value="select">Select</option>
                                            <option value="checkbox">Галочка</option>
                                            <option value="radio">Radio Button</option>
                                            <option value="true_false">Так / Ні</option>
                                        </optgroup>
                                        <optgroup label="Шаблон структуры">
                                            <option>Група</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- meta-field-card-body--children --}}
            <div 
                class="meta-field-card-body--children mb-0 collapse" 
                id="{{ $targetFieldsCollapse }}" 
                aria-labelledby="{{ $labelledbyFieldsCollapse }}"
            >
                <table class="table mb-0">
                    <tbody class="border-top-0">
                        <tr>
                            <td class="border-right bg-light" scope="row" width="400">
                                <label for="{{ $paramFieldSlugId }}" class="mb-0">
                                    <strong>Дочірні поля</strong>
                                </label>
                            </td>
                            <td>
                                <ul class="list-group rounded-0 w-100">
                                    
                                    <x-meta.nav />

                                    {{ $slot }}

                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</li>