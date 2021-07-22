<?php

namespace App\Traits\Models\Status;

use App\Models\Status\TenderRestart\AwaitingConfirmationStatus;
use App\Models\Status\TenderRestart\CanceledStatus;
use App\Models\Status\TenderRestart\ConfirmedStatus;
use App\Models\Status\TenderRestart\OnDesigningStatus;

/**
 *  @method setAsAwaitingConfirmation()
 *  @method setAsCanceled()
 *  @method setAsConfirmed()
 *  @method setAsOnDesigning()
 */
trait TenderRestartStatusesSetters
{
    
    /**
     * Set tender application status
     *
     * @return self
     */
    public function setAsAwaitingConfirmation(bool $save = true)
    {
        $this->status()->associate(AwaitingConfirmationStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }

    /**
     * Set tender application status
     *
     * @return self
     */
    public function setAsCanceled(bool $save = true)
    {
        $this->status()->associate(CanceledStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status
     *
     * @return self
     */
    public function setAsOnDesigning(bool $save = true)
    {
        $this->status()->associate(OnDesigningStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status
     *
     * @return self
     */
    public function setAsConfirmed(bool $save = true)
    {
        $this->status()->associate(ConfirmedStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
}
