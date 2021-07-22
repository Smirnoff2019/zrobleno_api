<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Payment\PaymentCreateRequest;
use App\Jobs\Contractor\Tenders\BuyPlaceOnTender;
use App\Models\Payment\Payment as PaymentModel;
use App\Models\Project\Project;
use App\Models\Status\TenderDeals\AgreedStatus;
use App\Models\Tender\Tender;
use App\Models\User\Contractor\Contractor;
use App\Repositories\Eloquent\Payment\Interfaces\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends ApiController
{

    /**
     * Instantiate a new controller instance.
     *
     * @param  PaymentModel $payment
     * @return void
     */
    public function __construct(PaymentModel $payment, PaymentRepositoryInterface $paymentRepository)
    {
        $this->middleware('auth:api');
        $this->payment    = $payment;
        $this->repository = $paymentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->collection($this->repository->allPagination(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Payment\PaymentCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentCreateRequest $request)
    {
        $data = $this->repository->create($request);
        return $this->resource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        var_dump($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = $this->repository->update($id, $request);

        return $this->resource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function costs(Request $request)
    {

        $bonus = PaymentModel::bonus()->sum('value');
        $main  = PaymentModel::main()->sum('value');

        return $this->success(
            [
                'bonus' => $bonus,
                'main'  => $main,
            ]
        );
    }

    public function statistic(Request $request)
    {

        $bonus = PaymentModel::bonus()->sum('value');
        $main  = PaymentModel::main()->sum('value');

        $incomes = Contractor::with('agreedDealsWithCustomers.tender.project')->find($request->user()->id)->agreedDealsWithCustomers->pluck('tender.project.total_price')->sum();

        return $this->success(
            [
                'costs' => [
                    'bonus' => $bonus,
                    'main'  => $main,
                ],
                'incomes' => $incomes
            ]
        );
    }

    public function buyParticipant(Request $request)
    {
        $request->validate([
            'tender_id' => 'required|integer',
        ]);
        
        return $this->resource(
            BuyPlaceOnTender::dispatchNow(
                $request->user(), 
                Tender::find($request->get('tender_id'))
            )
        );
    }

}
