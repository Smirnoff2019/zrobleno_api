<?php

namespace App\Services\Blade;

use App\Models\OptionsGroup\OptionsGroup;
use App\Models\Room\Room;

// use Illuminate\View\ComponentAttributeBag;

class CalculatorService
{
    /**
     * The сalculator options formulas
     *
     * @var array
     */
    public $сalculationFormulas = [
        [
            'label' => 'По площі (ФП1)',
            'value' => 'by_area_fp1',
        ],
        [
            'label' => 'По площі (ФП2)',
            'value' => 'by_area_fp2',
        ],
        [
            'label' => 'По площі (ФП3)',
            'value' => 'by_area_fp3',
        ],
        [
            'label' => 'По кількості (ФК)',
            'value' => 'by_count',
        ],
        [
            'label' => 'По площі (ФП2-WS)',
            'value' => 'by_area_fp2_ws',
        ],
    ];

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get calculator rooms list
     *
     * @return array
     */
    public function rooms()
    {
        return Room::get()->map(function ($status) {
            return [
                'label' => $status->name,
                'value' => $status->id,
            ];
        });
    }

    /**
     * Get calculator rooms list
     *
     * @return array
     */
    public function roomsByOptions()
    {
        return Room::get()->mapWithKeys(function ($room) {
            return [$room['id'] => $room['name']];
        })->all();

    }

    /**
     * Get calculator rooms list
     *
     * @return array
     */
    public function optionsGroupByOptions()
    {
        return OptionsGroup::get()->groupBy('room.name')->mapWithKeys(function ($group, $key) {
            return [
                $key => $group->mapWithKeys(function ($item) {
                    return [$item['id'] => $item['name']];
                })->all(),
            ];
        })->all();

    }

}
