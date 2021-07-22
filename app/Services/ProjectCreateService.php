<?php

namespace App\Services;

use App\Jobs\Project\ProjectCreate;
use App\Models\CalculatorOption\CeilingHeightCoefficient;
use App\Models\CalculatorOption\CoefficientPerRegion;
use App\Models\CalculatorOption\PropertyConditionCoefficient;
use App\Models\CalculatorOption\PropertyWallsConditionCoefficient;
use App\Models\Room\Bathroom;
use App\Models\Room\Bedroom;
use App\Models\Room\Corridor;
use App\Models\Room\Kitchen;
use App\Models\Room\LivingRoom;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Auth;

class ProjectCreateService
{
    /**
     * The faker instance
     *
     * @var Faker
     */
    public $faker;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->faker = Faker::create();
        //
    }

    /**
     * Make new data for project
     *
     * @return array
     */
    public function createNewProject($total_area = null, $total_price = null)
    {
        $projectData = $this->makeProjectData($total_area, $total_price);

        return ProjectCreate::dispatchNow(
            $projectData, 
            Auth::id() ?? 1
        );
    }

    /**
     * Make new data for project
     *
     * @return collect
     */
    public function makeProjectData($total_area = null, $total_price = null)
    {
        $rooms = [
            $this->makeProjectRoomData(Kitchen::first(), $room_1 = rand(4, 18)),
            $this->makeProjectRoomData(LivingRoom::first(), $room_2 = rand(12, 30)),
            $this->makeProjectRoomData(Bedroom::first(), $room_3 = rand(12, 30)),
            $this->makeProjectRoomData(Corridor::first(), $room_4 = rand(4, 8)),
            $this->makeProjectRoomData(Bathroom::first(), $room_5 = rand(4, 8)),
        ];

        $total_area = $room_1 + $room_2 + $room_3 + $room_4 + $room_5;

        $total_price = collect($rooms)->sum(function ($room) {
            return collect($room['options'])->sum('price') * rand(4, 20);
        });

        return collect([
            'walls_condition_id'    => PropertyWallsConditionCoefficient::inRandomOrder()->first('id')->id,
            'region_id'             => CoefficientPerRegion::inRandomOrder()->first('id')->id,
            'property_condition_id' => PropertyConditionCoefficient::inRandomOrder()->first('id')->id,
            'ceiling_height_id'     => CeilingHeightCoefficient::inRandomOrder()->first('id')->id,
            'city'                  => $this->faker->city,
            'address'               => $this->faker->streetAddress,
            'total_area'            => $total_area,
            'total_price'           => $total_price,
            'rooms'                 => $rooms,
        ]);
    }

    /**
     * Make new room data for project
     *
     * @return array
     */
    public function makeProjectRoomData($room, $area = null)
    {   
        $options = $room->options()->defaultSelected()->get(['id', 'quantity as count', 'price']);

        return [
            'name'    => $room->slug,
            'area'    => $area,
            'options' => $options->toArray(),
        ];
    }

    /**
     * Make new instance
     *
     * @return static
     */
    public static function make(...$args)
    {   
        return new static(...$args);
    }

}
