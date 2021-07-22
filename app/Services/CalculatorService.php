<?php

namespace App\Services;

use App\Http\Resources\Calculator\FormulaResourceCollection;
use App\Http\Resources\Calculator\RoomResourceCollection;
use App\Models\CalculatorOption\Coefficient;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\Formula;
use App\Models\Room\Room;

class CalculatorService
{

    /**
     * The calculator coefficients
     *
     * @var Room
     */
    public $rooms;

    /**
     * The calculator coefficients
     *
     * @var CoefficientPerRegion
     */
    public $coefficientPerRegion;

    /**
     * The calculator formulas
     *
     * @var Formula
     */
    public $formulas;

    /**
     * The calculator static data
     *
     * @var array
     */
    public $static;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct($rooms, $formulas, array $static)
    {
        $this->rooms    = new RoomResourceCollection($rooms);
        $this->static   = $static;
        $this->formulas = new FormulaResourceCollection($formulas);
    }

    /**
     * Get instance data
     *
     * @return array
     */
    public function get()
    {
        return [
            'rooms'    => $this->rooms,
            'static'   => $this->static,
            'formulas' => $this->formulas,
        ];
    }

    /**
     * Serialize instance to array
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'rooms'    => $this->rooms->toArray(),
            'static'   => $this->static,
            'formulas' => $this->formulas->toArray(),
        ];
    }

}
