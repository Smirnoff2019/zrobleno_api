<?php

use App\Models\Room\Bathroom;
use App\Models\Room\Bedroom;
use App\Models\Room\Corridor;
use App\Models\Room\Kitchen;
use App\Models\Room\KitchenLivingRoom;
use App\Models\Room\LivingRoom;
use App\Models\Room\Room;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(Room::class)
            ->states(Bathroom::class)
            ->create();

        factory(Room::class)
            ->states(Bedroom::class)
            ->create();

        factory(Room::class)
            ->states(Kitchen::class)
            ->create();

        factory(Room::class)
            ->states(LivingRoom::class)
            ->create();

        factory(Room::class)
            ->states(Corridor::class)
            ->create();

        factory(Room::class)
            ->states(KitchenLivingRoom::class)
            ->create();

    }

}
