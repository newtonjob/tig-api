<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirtimeAndDataRequest;

class DataController extends Controller
{
    public function __invoke(AirtimeAndDataRequest $request)
    {
        return $request->fulfill(2);
    }
}
