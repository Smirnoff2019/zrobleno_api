<?php

namespace App\Traits\Models\Status;

use App\Models\Status\TenderApplication\AwaitingConfirmationStatus;
use App\Models\Status\TenderApplication\AwaitingRestartStatus;
use App\Models\Status\TenderApplication\CanceledStatus;
use App\Models\Status\TenderApplication\ConfirmedStatus;
use App\Models\Status\TenderApplication\OnDesigningStatus;

/**
 *  @method setAsAwaitingConfirmation()
 *  @method setAsOnDesigning()
 *  @method setAsConfirmed()
 *  @method setAsCanceled()
 */
trait TenderApplicationStatusesSetters
{
    
    /**
     * Set tender application status as confirmed
     *
     * @return string
     */
    public function setAsConfirmed(bool $save = true)
    {
        $this->status()->associate(ConfirmedStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as canceled
     *
     * @return string
     */
    public function setAsCanceled(bool $save = true)
    {
        $this->status()->associate(CanceledStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as awaiting_confirmation
     *
     * @return string
     */
    public function setAsAwaitingConfirmation(bool $save = true)
    {
        $this->status()->associate(AwaitingConfirmationStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as on_designing
     *
     * @return string
     */
    public function setAsOnDesigning(bool $save = true)
    {
        $this->status()->associate(OnDesigningStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as AwaitingRestartStatus
     *
     * @return string
     */
    public function setAsAwaitingRestart(bool $save = true)
    {
        $this->status()->associate(AwaitingRestartStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
}
