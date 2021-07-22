<?php

namespace App\Traits\Models\Status;

use App\Models\Status\Tender\ActiveStatus;
use App\Models\Status\Tender\CompletedStatus;
use App\Models\Status\Tender\RecruitmentOfParticipantsStatus;
use App\Models\Status\Tender\SuspendedStatus;
use App\Models\Status\Tender\AwaitingConfirmationStatus;
use App\Models\Status\Tender\CanceledStatus;

/**
 *  @method setAsActive()
 *  @method setAsAwaitingConfirmation()
 *  @method setAsCanceled()
 *  @method setAsCompleted()
 *  @method setAsRecruitmentOfParticipants()
 *  @method setAsSuspended()
 */
trait TenderStatusesSetters
{
    
    /**
     * Set tender application status as ActiveStatus
     *
     * @return self
     */
    public function setAsActive(bool $save = true)
    {
        $this->status()->associate(ActiveStatus::first());
        if($save === true) $this->save();

        return $this;
    }
    
    /**
     * Set tender application status as AwaitingConfirmationStatus
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
     * Set tender application status as CanceledStatus
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
     * Set tender application status as CompletedStatus
     *
     * @return self
     */
    public function setAsCompleted(bool $save = true)
    {
        $this->status()->associate(CompletedStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as RecruitmentOfParticipantsStatus
     *
     * @return self
     */
    public function setAsRecruitmentOfParticipants(bool $save = true)
    {
        $this->status()->associate(RecruitmentOfParticipantsStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
    /**
     * Set tender application status as SuspendedStatus
     *
     * @return self
     */
    public function setAsSuspended(bool $save = true)
    {
        $this->status()->associate(SuspendedStatus::first());
        if($save === true) $this->save();
        
        return $this;
    }
    
}
