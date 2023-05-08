<?php

namespace App\Http\Controllers;

use App\Enums\Action;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function __invoke(Request $request)
    {
        $response = Http::tig()->get('/', [
            'action'   => Action::SESSION,
            'email_id' => $request->email,
            'pass_key' => $request->password,
        ])->object();

        if ($response->ex_resp_code != 0) {
            return Response::api($response->ex_resp_desc, status: 422);
        }

        return Response::api($response->ex_resp_desc, [
            'token' => "{$response->ex_ref_no}|{$response->sessionID}"
        ]);
    }
}
