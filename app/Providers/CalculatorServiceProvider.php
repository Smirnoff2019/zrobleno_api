<?php

namespace App\Providers;

use App\Http\Controllers\API\Calculator\CalculatorApiController;
use App\Http\Resources\Calculator\Adapters\FormFieldRoomResource;
use App\Http\Resources\Calculator\Adapters\FormOptionCoefficientResource;
use App\Http\Resources\Room\RoomResource;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\Coefficient;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\Formula;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;
use App\Models\Room\Room;
use App\Services\CalculatorService;
use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $rooms = Room::active()->get();

        $this->app
            ->when([
                CalculatorApiController::class
            ])
            ->needs(CalculatorService::class)
            ->give(function($app) use($rooms) {
                return new CalculatorService(
                    $rooms,
                    // CoefficientPerRegion::all(),
                    Formula::get(),
                    $this->app->make('static_calculator_resources')
                );
            });

        $this->app->bind('static_calculator_resources', function ($app) use($rooms) {
            $WS = PropertyWallsConditionCoefficient::get();

            return [
                'tabs' => [
                    'form_project_params' => [
                        'name'  => "Параметри об'єкту",
                        'title' => "Параметри об'єкту",
                        'fields' => [
                            'region' => [
                                'label'   => "Область",
                                'name'    => 'region',
                                'options' => FormOptionCoefficientResource::collection(CoefficientPerRegion::all()),
                            ],
                            'city' => [
                                'label' => "Місто",
                                'name'  => 'city',
                            ],
                            'property_condition' => [
                                'label'   => "Статус об'єкту",
                                'name'    => 'property_condition',
                                'options' =>  FormOptionCoefficientResource::collection(PropertyConditionCoefficient::all()),
                            ],
                            'ceiling_height' => [
                                'label'   => "Висота стелі",
                                'name'    => 'ceiling_height',
                                'options' => FormOptionCoefficientResource::collection(CeilingHeightCoefficient::all()),
                            ],
                        ],
                        'buttons' => [
                            'next_1' => [
                                'label' => 'Стан стін приміщення'
                            ],
                            'next_2' => [
                                'label' => 'Перейти до вибору кімнат'
                            ]
                        ]
                    ],
                    'form_condition_of_walls' => [
                        'name'        => 'Стан стін приміщення',
                        'title'       => 'Стан стін приміщення',
                        'description' => 'Sed vulputate odio ut enim blandit volutpat maecenas volutpat. Purus ut faucibus pulvinar elementum integer enim. Integer vitae justo eget magna fermentum iaculis eu non.',
                        'options'     => $WS->map(function($coff) {
                            if($coff->slug == 'empty-walls') {
                                $coff->default = true; 
                                $coff->url = "https://app.zrobleno.com.ua/storage/users/3/GHi9UyYiGT_1614883282.webp"; 
                            } else {
                                $coff->default = false; 
                                $coff->url = "https://app.zrobleno.com.ua/storage/users/3/1HgYzJrfhr_1614883334.webp"; 
                            }
            
                            return $coff;
                        })->toArray(),
                        'buttons' => [
                            'next' => [
                                'label' => 'Перейти до вибору кімнат'
                            ],
                            'prev' => [
                                'label' => "Параметри об'єкту"
                            ]
                        ]
                    ],
                    'form_property_rooms' => [
                        'name'  => "Вибір кімнат",
                        'title' => "Вибір кімнат",
                        'fields' => FormFieldRoomResource::collection($rooms),
                        'tags' => [
                            'area' => 'Площа',
                            'area_marking' => 'м'
                        ],
                        'buttons' => [
                            'next' => [
                                'label' => "Перейти до дизайну"
                            ],
                            'prev_1' => [
                                'label' => "Стан стін приміщення"
                            ],
                            'prev_2' => [
                                'label' => "Параметри об'єкту"
                            ]
                        ]
                    ]
                ],
            ];
        });

    }
}
