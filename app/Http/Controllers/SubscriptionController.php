<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function list(Request $request) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions.json', $request->all());

        $response = json_decode($maxioRequest->getBody());
        $code = $maxioRequest->getStatusCode();

        return response()->json($response, $code);
    }
}
