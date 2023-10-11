<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private $uri;

    public function __construct() {
        $this->uri = 'subscriptions.json';
    }

    protected function setRequest($method, $request) {
        $req = $this->maxioRequest($method, $this->uri, $request);

        return $req;
    }

    public function index(Request $request) {
        $maxioRequest = $this->setRequest('GET', $request->all());

        $message = 'Subscription List retrieved successfully.';

        return $this->response($maxioRequest, $message);
    }

    public function store(Request $request) {
        $maxioRequest = $this->setRequest('POST', $request->all());

        $message = 'Subscription List created successfully.';

        return $this->response($maxioRequest, $message);
    }
}
