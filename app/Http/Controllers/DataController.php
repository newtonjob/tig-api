<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class DataController extends Controller
{
    public function __invoke(Request $request)
    {
        $response = Http::tig()->get('/', [
            'action'       => 2,
            'ex_ref_no'    => 'xxx', // Todo
            'sessionID'    => 'xxx', // Todo
            'trans_amount' => $request->amount,
            'vend_email'   => $request->email, //Todo: get email from token user.
            'bill_id'      => $request->bill_id,
            'item_id'      => $request->item_id,
            'phone_numb'   => $request->phone,
        ])->object();

        if ($response->ex_resp_code != 90000) {
            return Response::api($response->ex_resp_desc, status: 422);
        }

        return Response::api($response->ex_resp_desc, [
            'reference'     => $response->tnx_ref,
            'vtu_reference' => $response->vtu_ref,
            'type'          => $response->trans_type,
            'amount'        => $response->trans_amount,
        ]);
    }
}
