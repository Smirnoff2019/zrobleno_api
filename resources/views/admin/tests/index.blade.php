@extends('layouts.app')

@section('body-class', 'bg-light')

@section('content')
        
        <div class="row">
            
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body pb-5">
                        <h5 class="card-title">Отправить уведомление</h5>
                        <h6 class="card-subtitle mt-3 mb-4 text-muted">Отправить тестовое уведомление через отложеные задачи</h6>
                        <form action="{{ route('admin.tests.queues.send') }}" method="POST" class="">
                            @csrf
                            <x-input 
                                type="text" 
                                label="Тема:" 
                                name="subject" 
                                :value="old('subject') ?? 'Тестовое уведомление'" 
                                placeholder="5"
                                required
                            />
                            <x-textarea
                                label="Текст уведомления:"
                                name="message"
                                :value="old('message') ?? $faker->text"
                                placeholder="Введіть відомості...">
                            </x-textarea>
                            <x-input 
                                type="number" 
                                label="Отправить через (мин.):" 
                                name="time" 
                                :value="old('time') ?? 1" 
                                placeholder="5"
                                required
                            />
                            <button class="btn btn-primary px-3 mt-4">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        
@endsection

@section('scripts')
    
@endsection
