<?php

namespace App\Repositories\Eloquent\Payment;

use App\Events\Payments\NewPaymentEvent;
use App\Models\Status\PaymentStatus;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Payment\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Kernel\Repository;
use App\Models\Payment\Payment;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{

    protected $with = [
        'status'
    ];
    /**
     * Create a new repository instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all of the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all()
    {
        return $this->model
            ->history()
            ->with($this->with)
            ->latest()
            ->get();
    }

    /**
     * Get all of the models pagination from the database.
     *
     * @param  int $perPage
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function allPagination(int $perPage = null)
    {

        return $this->model
            ->history()
            ->with($this->with)
            ->latest()
            ->paginate($perPage ?? $this->perPage);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id)
    {
        //
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Request $request)
    {
        $account = $request->user()->accountMain()->first();

        $status = PaymentStatus::slug($request->status)->first();

        $data = $this->model::create(array_merge($request->only('type', 'value'),[
            'order_reference' => $request->order_reference,
            'balance' => $account->balance,
            'status_id' => $status && isset($status->id) ? $status->id : null,
            'account_id' => $account->id
        ]));


        return $data;

    }

    /**
     * Update a record by its primary key in the database or throw an exception.
     *
     * @param  int $id
     * @param  Illuminate\Http\Request $request
     * @return int|bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function update(int $id, Request $request)
    {
        $payment = $this->model::find($id);

        $status = PaymentStatus::slug($request->status)->first();

        $account = $request->user()->accountMain()->first();


        if($status->slug === 'approved') {
            $newBalance = $account->balance + $payment->value;
            $account->update(['balance' => $newBalance]);
            // event(new NewPaymentEvent($payment, $request->user()));
        }

        $payment->update(['status_id' => $status->id]);

        return  $payment;
    }

    /**
     * Delete a record by its primary key from the database or throw an exception.
     *
     * @param  int  $id
     * @return bool
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function destroy(int $id)
    {
        //
    }

}
