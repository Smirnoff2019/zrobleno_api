@extends('layouts.sing-up')

@push('script_middle')
 
@endpush

@section('content')
<div class="container-fruid h-100">
    <div class="d-flex justify-content-center py-5 h-100">

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    
                    @if($authenticate_error ?? session('authenticate_error') ?? false)
                        <x-alert type="danger" :message="$authenticate_error ?? session('authenticate_error')"/>
                    @endif

                    <div class="card shadow-lg">
                        <div class="card-body">
                            
                            <h3 class="text-center mt-2 mb-4">Реєстрація підрядника</h3>
                            
                            <form action="{{ route('admin.contractors.sing-up.store', ['token' => $access_token]) }}" method="POST" class="px-2">
                                @csrf

                                <input type="hidden" name="access_token" id="access_token" value="{{ $access_token }}">

                                <p class="text-muted border-bottom font-w-500">Особисті дані</p>

                                @inject('faker', 'Faker\Generator')

                                <x-input
                                    type="text"
                                    label="Ім'я:"
                                    name="first_name"
                                    :value="old('first_name') ?? $faker->firstName"
                                    placeholder="Ім'я..."
                                    required>
                                </x-input>

                                <x-input
                                    type="text"
                                    label="Прізвище:"
                                    name="last_name"
                                    :value="old('last_name') ?? $faker->lastName"
                                    placeholder="Прізвище..."
                                    required>
                                </x-input>

                                <x-input
                                    type="text"
                                    label="Побатькові:"
                                    name="middle_name"
                                    :value="old('middle_name') ?? $faker->name"
                                    placeholder="Побатькові..."
                                    required>
                                </x-input>

                                <p class="text-muted border-bottom font-w-500 mt-4">Параметри доступу та безпеки</p>

                                <x-input
                                    type="phone"
                                    label="Телефон:"
                                    name="phone"
                                    value='{{ old("phone") ?? "096".rand(1000000, 9999999) }}'
                                    placeholder='{{ "096".rand(1000000, 9999999) }}'
                                    required>
                                </x-input>

                                <x-input
                                    type="email" 
                                    label="Логин:" 
                                    name="email" 
                                    :value="old('email') ?? $faker->unique()->safeEmail" 
                                    placeholder="{{ $faker->unique()->safeEmail }}"
                                    required>
                                </x-input>

                                <x-input 
                                    type="password" 
                                    label="Пароль:" 
                                    name="password" 
                                    :value="old('password')" 
                                    placeholder="Введіть пароль"
                                    required>
                                </x-input>

                                <x-input
                                    type="password"
                                    label="Повторення паролю:"
                                    name="password_confirmation"
                                    :value="old('password_confirmation')"
                                    placeholder="Повторіть пароль"
                                    password_confirmation
                                    required>
                                </x-input>
                                
                                <p class="text-muted border-bottom font-w-500 mt-4">Юридичні дані</p>

                                <x-input
                                    type="text"
                                    label="Банківський рахунок:"
                                    name="bill"
                                    :value="old('bill') ?? 'UA89235299000002600000627'.rand(100, 999)"
                                    placeholder="UA89235299000002600000627426"
                                    required>
                                </x-input>

                                <x-input
                                    type="text"
                                    label="МФО:"
                                    name="MFO"
                                    :value="old('MFO') ?? '300'.rand(100, 999)"
                                    placeholder="300711"
                                    required>
                                </x-input>

                                <x-input
                                    type="text"
                                    label="ІПН/ЄДРПОУ:"
                                    name="EDRPOU_code"
                                    :value="old('EDRPOU_code') ?? '725345'.rand(100, 999)"
                                    placeholder="ЄДРПОУ номер"
                                        required>
                                </x-input>

                                <x-input
                                    type="text"
                                    label="Серія та номер паспорту:"
                                    name="serial_number"
                                    :value="old('serial_number') ?? 'АГ № 360'.rand(100, 999).' від 23.12.2013 р'"
                                    placeholder="Серія та номер паспорту в форматі - АГ № 89708 від 18.11.2019 р"
                                    required>
                                </x-input>

                                <x-select
                                    label="Юридичний статус:"
                                    name="legal_status"
                                    :value="old('legal_status')"
                                >
                                    <option @selected(old('legal_status') == ($value = 'Фізична Особа-Підприємець')) value="{{ $value }}">{{ $value }}</option>
                                    <option @selected(old('legal_status') == ($value = 'Юридична Особа-Підприємець')) value="{{ $value }}">{{ $value }}</option>
                                </x-select>

                                <div class="mb-3 pt-2 d-flex justify-content-center">
                                    <button class="btn btn-primary px-4 mt-3">Зареєструватись</button>
                                </div>
                            </form>

                        </div>
                        
                    </div>

                </div>
            </div>
        
        </div>

    </div>
</div>
@endsection

@section('scripts')
    
@endsection
