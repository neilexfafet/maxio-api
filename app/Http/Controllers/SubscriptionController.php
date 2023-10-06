<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function list(Request $request) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions.json', $request->all());

        if($maxioRequest['success']) {
            $message = 'Subscription List retrieved successfully.';
            $data = json_decode($maxioRequest['data']);
            
            return $this->sendResponse($data, $message);
        } else {
            return $this->sendError($maxioRequest['message'], $maxioRequest['code']);
        }
    }
}
