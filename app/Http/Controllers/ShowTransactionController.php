<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ShowTransactionController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $response = Http::tig()->get('/', [
            'action'    => 3,
            'ex_ref_no' => $request->user()->ref_no,
            'sessionID' => $request->user()->id,
            'email_id'  => $request->user()->email,
            'trans_id'  => $id,
        ])->json();

        return Response::api('Transaction status retrieved', $response);
    }
}
