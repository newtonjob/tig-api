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
            'sessionID' => 'xxx', // Todo
            'email_id'  => $request->email, //Todo: get email from token user.
            'trans_id'  => $id,
        ])->json();

        return Response::api('Transaction status retrieved', $response);
    }
}
