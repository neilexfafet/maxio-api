<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function index(Request $request) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions.json', $request->all());

        $message = 'Subscription List retrieved successfully.';

        return $this->response($maxioRequest, $message);
    }

    public function find($id) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions/'.$id.'.json');

        $message = 'Subscription retrieved successfully';

        return $this->response($maxioRequest, $message);
    }

    public function store(Request $request) {
        $maxioRequest = $this->maxioRequest('POST', 'subscriptions.json', $request->all());

        $message = 'Subscription created successfully.';

        return $this->response($maxioRequest, $message);
    }

    public function update(Request $request, $id) {
        $maxioRequest = $this->maxioRequest('PUT', 'subscriptions/'.$id.'.json', $request->all());

        $message = 'Subscription updated successfully.';

        return $this->response($maxioRequest, $message);
    }
}
