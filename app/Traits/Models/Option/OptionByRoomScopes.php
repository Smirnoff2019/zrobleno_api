<?php

namespace App\Traits\Models\Option;

use App\Models\Room\Bathroom;
use App\Models\Room\Bedroom;
use App\Models\Room\Corridor;
use App\Models\Room\Kitchen;
use App\Models\Room\KitchenLivingRoom;
use App\Models\Room\LivingRoom;
use App\Models\Room\Room;
use Illuminate\Database\Eloquent\Builder;

/**
 *  @method forRoom($slug)
 *  @method forKitchenLivingRoom()
 *  @method forKitchen()
 *  @method forLivingRoom()
 *  @method forBedroom()
 *  @method forCorridor()
 *  @method forBathroom()
 */
trait OptionByRoomScopes
{

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @param string  $slug
     * @return Builder
     *
     * @method Builder forRoom($slug)
     */
    public function scopeForRoom(Builder $query, string $slug): Builder
    {
        return $query->whereHas('room', function (Builder $query) use ($slug) {
            $query->where(
                Room::COLUMN_SLUG,
                $slug
            );
        });
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forKitchenLivingRoom()
     */
    public function scopeForKitchenLivingRoom(Builder $query): Builder
    {
        return $query->forRoom(KitchenLivingRoom::DEFAULT_SLUG);
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forKitchen()
     */
    public function scopeForKitchen(Builder $query): Builder
    {
        return $query->forRoom(Kitchen::DEFAULT_SLUG);
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forLivingRoom()
     */
    public function scopeForLivingRoom(Builder $query): Builder
    {
        return $query->forRoom(LivingRoom::DEFAULT_SLUG);
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forBedroom()
     */
    public function scopeForBedroom(Builder $query): Builder
    {
        return $query->forRoom(Bedroom::DEFAULT_SLUG);
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forCorridor()
     */
    public function scopeForCorridor(Builder $query): Builder
    {
        return $query->forRoom(Corridor::DEFAULT_SLUG);
    }

    /**
     * Scope a query to only include posts with query
     *
     * @param Builder $query
     * @return Builder
     *
     * @method Builder forBathroom()
     */
    public function scopeForBathroom(Builder $query): Builder
    {
        return $query->forRoom(Bathroom::DEFAULT_SLUG);
    }

}
