<?php

namespace App\Services\Blade;

use App\Models\Status\CommonStatus;
use App\Models\Status\ComplaintStatus;
use App\Models\Status\Status;

class StatusesService
{
    /**
     * The status model
     *
     * @var Status
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
     * @return Status
     */
    public function common()
    {
        return CommonStatus::get()->map(function($status) {
            return [
                'label' => $status->name,
                'value' => $status->id,
            ];
        });
    }

    /**
     * Get complaint statuses
     *
     * @return Status
     */
    public function complaint()
    {
        return ComplaintStatus::get()->map(function($status) {
            return [
                'label' => $status->name,
                'value' => $status->id,
            ];
        });
    }

}
