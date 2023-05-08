<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BundleController extends Controller
{
    public function __invoke(Request $request)
    {
        return Http::tig()->get('/', [
            'action'    => 4,
            'sessionID' => 'xxx', // Todo
            'email_id'  => $request->email, //Todo: get email from token user.
            'bill_id'   => $request->bill_id,
        ])->json();
    }
}
