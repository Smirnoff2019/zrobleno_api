<?php

use Illuminate\Database\Seeder;

use App\Models\Status\{
    ComplaintStatus,
    Status,
    PaymentStatus,
    CommonStatus,
    TenderStatus,
    TenderApplicationStatus,
    TenderRestartStatus,
    TenderDealStatus
};

use App\Models\Status\Common\ {
    ActiveStatus        as Common_ActiveStatus,
    InactiveStatus      as Common_InactiveStatus
};

use App\Models\Status\Payments\ {
    PendingStatus       as Payments_PendingStatus,
    ApprovedStatus      as Payments_ApprovedStatus,
    DeclinedStatus      as Payments_DeclinedStatus,
    InprocessingStatus  as Payments_InprocessingStatus
};

use App\Models\Status\Tender\ {
    ActiveStatus                    as Tender_ActiveStatus,
    CompletedStatus                 as Tender_CompletedStatus,
    SuspendedStatus                 as Tender_SuspendedStatus,
    RecruitmentOfParticipantsStatus as Tender_RecruitmentOfParticipantsStatus,
    CanceledStatus                  as Tender_CanceledStatus,
    AwaitingConfirmationStatus      as Tender_AwaitingConfirmationStatus
};

use App\Models\Status\TenderApplication\ {
    ConfirmedStatus             as TenderApplication_ConfirmedStatus,
    OnDesigningStatus           as TenderApplication_OnDesigningStatus,
    CanceledStatus              as TenderApplication_CanceledStatus,
    AwaitingConfirmationStatus  as TenderApplication_AwaitingConfirmationStatus,
    AwaitingRestartStatus       as TenderApplication_AwaitingRestartStatus
};

use App\Models\Status\TenderRestart\ {
    ConfirmedStatus             as TenderRestart_ConfirmedStatus,
    OnDesigningStatus           as TenderRestart_OnDesigningStatus,
    CanceledStatus              as TenderRestart_CanceledStatus,
    AwaitingConfirmationStatus  as TenderRestart_AwaitingConfirmationStatus
};

use App\Models\Status\TenderDeals\ {
    PendingStatus  as TenderDeals_PendingStatus,
    AgreedStatus   as TenderDeals_AgreedStatus,
    RejectedStatus as TenderDeals_RejectedStatus
};

use App\Models\Status\Complaint\ {
    InProcessingStatus as Complaint_InProcessingStatus,
    ProcessedStatus    as Complaint_ProcessedStatus,
    SatisfiedStatus    as Complaint_SatisfiedStatus,
    RejectedStatus     as Complaint_RejectedStatus
};

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(PaymentStatus::class)->states(Payments_ApprovedStatus::class)->create();
        factory(PaymentStatus::class)->states(Payments_PendingStatus::class)->create();
        factory(PaymentStatus::class)->states(Payments_DeclinedStatus::class)->create();
        factory(PaymentStatus::class)->states(Payments_InprocessingStatus::class)->create();

        factory(TenderApplicationStatus::class)->states(TenderApplication_OnDesigningStatus::class)->create();
        factory(TenderApplicationStatus::class)->states(TenderApplication_AwaitingConfirmationStatus::class)->create();
        factory(TenderApplicationStatus::class)->states(TenderApplication_ConfirmedStatus::class)->create();
        factory(TenderApplicationStatus::class)->states(TenderApplication_CanceledStatus::class)->create();
        factory(TenderApplicationStatus::class)->states(TenderApplication_AwaitingRestartStatus::class)->create();

        factory(TenderRestartStatus::class)->states(TenderRestart_OnDesigningStatus::class)->create();
        factory(TenderRestartStatus::class)->states(TenderRestart_AwaitingConfirmationStatus::class)->create();
        factory(TenderRestartStatus::class)->states(TenderRestart_ConfirmedStatus::class)->create();
        factory(TenderRestartStatus::class)->states(TenderRestart_CanceledStatus::class)->create();
        
        factory(TenderStatus::class)->states(Tender_ActiveStatus::class)->create();
        factory(TenderStatus::class)->states(Tender_RecruitmentOfParticipantsStatus::class)->create();
        factory(TenderStatus::class)->states(Tender_AwaitingConfirmationStatus::class)->create();
        factory(TenderStatus::class)->states(Tender_SuspendedStatus::class)->create();
        factory(TenderStatus::class)->states(Tender_CompletedStatus::class)->create();
        factory(TenderStatus::class)->states(Tender_CanceledStatus::class)->create();

        factory(CommonStatus::class)->states(Common_ActiveStatus::class)->create();
        factory(CommonStatus::class)->states(Common_InactiveStatus::class)->create();

        factory(TenderDealStatus::class)->states(TenderDeals_PendingStatus::class)->create();
        factory(TenderDealStatus::class)->states(TenderDeals_AgreedStatus::class)->create();
        factory(TenderDealStatus::class)->states(TenderDeals_RejectedStatus::class)->create();

        factory(ComplaintStatus::class)->states(Complaint_InProcessingStatus::class)->create();
        factory(ComplaintStatus::class)->states(Complaint_ProcessedStatus::class)->create();
        factory(ComplaintStatus::class)->states(Complaint_SatisfiedStatus::class)->create();
        factory(ComplaintStatus::class)->states(Complaint_RejectedStatus::class)->create();

    }
}
