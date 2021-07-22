@extends('layouts.app')

@section('container-class', 'container-fluid')

@section('content')
    <div class="row">
        <div class="col-auto" style="width: 40rem;">
            <div class="card shadow">
                <img
                        class="card-img-top rounded-circle w-25 p-3 h-25 d-inline-block mx-auto"
                        src="{{$record->image->file->url ?? ''}}"
                        alt="аватар відсутній">
                <div class="card-body">
                    <blockquote class="blockquote text-center">
                        <h3 class="card-title">{{$record->last_name ?? ''}} {{$record->first_name ?? ''}}</h3>
                        <p class="mb-0">{{$record->middle_name ?? ''}}</p>
                    </blockquote>
                    <br>
                    <h4 class="card-title">Особисті відомості:</h4>
                    <p class="card-text font-weight-bold">Поштова адреса:
                        <i class="font-weight-light">{{$record->email ?? ''}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Телефон:
                        <i class="font-weight-light">{{$record->phone ?? ''}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Роль в проекті:
                        <i class="font-weight-light">{{$record->role->name ?? ''}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Статус:
                        <i class="font-weight-light">{{$record->status->name ?? ''}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Скарги:
                        <i class="font-weight-light">{{ '0'}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Відповіді:
                        <i class="font-weight-light">{{ '0'}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Баланс:
                        <i class="font-weight-light">{{ '0'}}</i>
                    </p>
                    <p class="card-text font-weight-bold">Знижки:
                        <i class="font-weight-light">{{ '0'}}</i>
                    </p>

                    <h5 class="card-text"><small class="text-muted">Last updated 3 mins ago</small></h5>
                </div>
            </div>
        </div>
        <div class="col">
            <form
                    class="card shadow mb-5"
                    action="{{ $action ?? $routes->update ? route($routes->update, $record->id) : '#' }}"
                    method="{{ $method ?? 'POST' }}">

                <nav class="card-header">
                    @yield('card-header')
                    <div class="nav nav-tabs *px-3 card-header-tabs" id="nav-tab" role="tablist">

                        <x-form-nav-tab name="nav-1" label="Основне" active="true"></x-form-nav-tab>
                        <x-form-nav-tab name="nav-2" label="Параметри входу та сповіщення"></x-form-nav-tab>
                        <x-form-nav-tab name="nav-3" label="Параметри доступу"></x-form-nav-tab>
                        @if($record->role->slug == 'contractor')
                        <x-form-nav-tab name="nav-4" label="Портфолио"></x-form-nav-tab>
                        @endif

                    </div>
                </nav>

                <div class="card-body">

                    @csrf
                    @method($mv_method ?? 'PUT')

                    <input type="hidden" name="id" value="{{ $record->id }}">

                    <div class="tab-content p-1 *mt-4" id="nav-tabContent">
                        <x-form-nav-tab-content name="nav-1" active="true" >

                            <x-input-image
                                label="Аватар:"
                                name="image_id"
                                :value="$record->image_id ?? ''"
                                :url="$record->image->file->url ?? ''"
                                mode="single">
                            </x-input-image>

                            <x-input
                                type="text"
                                label="Прізвище:"
                                name="last_name"
                                :value="old('last_name') ?? $record->last_name"
                                placeholder="Введіть прізвище...">
                            </x-input>

                            <x-input
                                type="text"
                                label="Ім'я:"
                                name="first_name"
                                :value="old('first_name') ?? $record->first_name"
                                placeholder="Введіть ім'я...">
                            </x-input>

                            <x-input
                                type="text"
                                label="Побатькові:"
                                name="middle_name"
                                :value="old('middle_name') ?? $record->middle_name"
                                placeholder="Введіть побатькові...">
                            </x-input>

                        </x-form-nav-tab-content>

                        <x-form-nav-tab-content name="nav-2">

                            <x-input
                                type="number"
                                label="Контактний телефон:"
                                name="phone"
                                :value="old('phone') ?? $record->phone"
                                placeholder="Введіть номер телефону">
                            </x-input>

                            <x-input
                                type="email"
                                label="E-mail:"
                                name="email"
                                :value="old('email') ?? $record->email"
                                placeholder="Введіть E-mail адресу">
                            </x-input>

                        </x-form-nav-tab-content>

                        <x-form-nav-tab-content name="nav-3">

                            @inject('statuses', 'App\Services\Blade\StatusesService')
                            <x-select
                                label="Статус:"
                                name="status_id"
                                :value="old('status_id')"
                                :options="$statuses->common()">
                            </x-select>

                            @inject('roles', 'App\Services\Blade\RolesService')
                            <x-select
                                label="Роль:"
                                name="role_id"
                                :value="old('role_id') ?? $record->role_id"
                                :options="$roles->getRole()">
                            </x-select>

                        </x-form-nav-tab-content>

                        <x-form-nav-tab-content name="nav-4">

                            <div id="accordion">

                                @forelse($record->portfolios as $portfolio)
                                <div class="card">
                                    
                                    <div class="card-header">
                                        <h6 class="mb-0">
                                            <a href="#collapse-portfolio-{{ $loop->iteration }}" 
                                                class="" 
                                                role="button" 
                                                data-toggle="collapse" 
                                                aria-expanded="true"
                                            >{{ $portfolio->name }}</a>
                                        </h6>
                                    </div>

                                    <div id="collapse-portfolio-{{ $loop->iteration }}" class="collapse @if($loop->first) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <input type="hidden" name="portfolios[{{ $portfolio->id }}][id]" value="{{ $portfolio->id }}">
                                            <x-input
                                                id="portfolio-inp-name-{{ $portfolio->id }}"
                                                type="text"
                                                label="Назва:"
                                                name="portfolios[{{ $portfolio->id }}][name]"
                                                :value="$portfolio->name"
                                                placeholder="Введіть назву..."
                                            >
                                            </x-input>

                                            <x-input
                                                type="text"
                                                label="Ярлик:"
                                                name="portfolios[{{ $portfolio->id }}][slug]"
                                                data-slugable
                                                data-slugify="input#portfolio-inp-name-{{ $portfolio->id }}"
                                                :value="$portfolio->slug"
                                                placeholder="Додайте ярлык"
                                            >
                                            </x-input>

                                            <x-input
                                                type="number"
                                                label="Загальна площа:"
                                                name="portfolios[{{ $portfolio->id }}][total_area]"
                                                :value="$portfolio->total_area"
                                                placeholder="34"
                                            >
                                            </x-input>

                                            <x-input
                                                type="number"
                                                label="Тривалість:"
                                                name="portfolios[{{ $portfolio->id }}][duration]"
                                                :value="$portfolio->duration"
                                                placeholder="31"
                                            >
                                            </x-input>

                                            <x-input
                                                type="number"
                                                label="Бюджет:"
                                                name="portfolios[{{ $portfolio->id }}][budget]"
                                                :value="$portfolio->budget"
                                                placeholder="120650"
                                            >
                                            </x-input>

                                            <x-input-image
                                                label="Обкладинка:"
                                                name="portfolios[{{ $portfolio->id }}][image_id]"
                                                :value="$portfolio->image_id"
                                                :url="$portfolio->cover->file->url ?? ''"
                                                mode="single"
                                            >
                                            </x-input-image>

                                            <div class="border border-silver p-3 w-100 bg-light mb-3">

                                                <h5 class="mb-3">Зображення портфоліо:</h5>

                                                <div id="portfolios-images-area-{{ $portfolio->id }}">
                                                    @forelse ($portfolio->images as $image)
                                                        <x-input-image
                                                            label="Зображення:"
                                                            name="portfolios[{{ $portfolio->id }}][images][]"
                                                            :value="$image->id"
                                                            :url="$image->file->url ?? ''"
                                                            mode="single"
                                                        >
                                                        </x-input-image>
                                                    @empty
                                                        <x-input-image
                                                            label="Зображення:"
                                                            name="portfolios[{{ $portfolio->id }}][images][]"
                                                            mode="single"
                                                        >
                                                        </x-input-image>
                                                    @endforelse
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary px-4 append-new-contractor-portfolio-image" data-append-action="{{ route('admin.api.append-field') }}" data-append-area="#portfolios-images-area-{{ $portfolio->id }}" data-append-method="find" data-append-data='@json(['label' => 'Зображення', 'name' => 'portfolios['.$portfolio->id.'][images][]', 'type' => 'image'])'>+ Додати зображення</button>
                                                </div>

                                            </div>

                                            <x-select
                                                label="Статус:"
                                                name="portfolios[{{ $portfolio->id }}][status_id]"
                                                :value="$portfolio->status_id"
                                                :options="$statuses->common()"
                                            >
                                            </x-select>
                                        </div>
                                    </div>
                                </div>
                                {{-- started Empty --}}
                                @empty
                                    @include('admin.users._empty-portfolio-card')
                                {{-- end Empty --}}
                                @endforelse
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" id="append-new-contractor-portfolio" class="btn btn-outline-primary px-3" data-action="{{ route('admin.api.make-new-contractor-portfolio') }}">+ Додати портфоліо</button>
                            </div>

                        </x-form-nav-tab-content>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span class="small text-muted">
                        <i class="far fa-calendar-check mr-1"></i>
                        {{ $record->created_at ?? 'Not found' }}
                    </span>
                    <x-submit-btn></x-submit-btn>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('modals')
    <x-modals.gallery 
        name="modal-galery-for-meta"
    />  
@endpush
