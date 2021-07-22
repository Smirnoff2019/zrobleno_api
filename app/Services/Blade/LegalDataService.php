<?php

namespace App\Services\Blade;

use App\Models\UserLegalData\UserLegalData;

class LegalDataService
{

    /**
     * The legal data from user model
     *
     * @var UserLegalData
     */
    public $model;

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
     * Get common statuses
     *
     * @return UserLegalData
     */
    public function legal(): UserLegalData
    {
        return UserLegalData::get()->map(function($userLegalData) {
            return [
                'label' => $userLegalData->MFO,
                'value' => $userLegalData->id,
            ];
        });
    }

}
