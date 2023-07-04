<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class AirtimeAndDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount'  => $this->is('/airtime') ? 'required' : '',
            'item_id' => $this->is('/data') ? 'required' : '',
            'bill_id' => 'required',
            'phone'   => 'required',
        ];
    }

    /**
     * Fulfill the request.
     */
    public function fulfill($action)
    {
        $response = Http::tig()->get('/', [
            'action'     => $action,
            'ex_ref_no'  => $this->user()->ref_no,
            'sessionID'  => $this->user()->id,
            'vend_email' => $this->user()->email,
            'trans_amt'  => $this->amount,
            'bill_id'    => $this->bill_id,
            'item_id'    => $this->item_id,
            'phone_numb' => $this->phone,
        ])->json(0);

        if ($response['ex_resp_code'] != 90000) {
            return Response::api($response['ex_resp_desc'], status: 422);
        }

        return Response::api($response['ex_resp_desc'], [
            'reference'     => Arr::get($response, 'tnx_ref'),
            'vtu_reference' => Arr::get($response, 'vtu_ref'),
            'type'          => $response['trans_type'],
            'amount'        => $response['trans_amt'],
        ]);
    }
}
