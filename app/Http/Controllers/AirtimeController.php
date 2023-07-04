<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirtimeAndDataRequest;

class AirtimeController extends Controller
{
    public function __invoke(AirtimeAndDataRequest $request)
    {
        return $request->fulfill();
    }
}
