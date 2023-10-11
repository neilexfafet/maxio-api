<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Subscriptions\CreateRequest;
use App\Http\Requests\Subscriptions\UpdateRequest;

class SubscriptionController extends Controller
{
    /**
     * Display List of Subscriptions
     * @group Subscriptions
     */
    public function index(Request $request) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions.json', $request->all());

        $message = 'Subscription List retrieved successfully.';

        return $this->response($maxioRequest, $message);
    }

    /**
     * Display details of a Subscription
     * @urlParam id integer required . Example: 1
     * @group Subscriptions
     */
    public function find($id) {
        $maxioRequest = $this->maxioRequest('GET', 'subscriptions/'.$id.'.json');

        $message = 'Subscription retrieved successfully';

        return $this->response($maxioRequest, $message);
    }

    /**
     * Create or Store Subscription
     * @group Subscriptions
     */
    public function store(CreateRequest $request) {
        $maxioRequest = $this->maxioRequest('POST', 'subscriptions.json', $request->all());

        $message = 'Subscription created successfully.';

        return $this->response($maxioRequest, $message);
    }

    /**
     * Update Subscription
     * @urlParam id integer required . Example: 1
     * @group Subscriptions
     */
    public function update(UpdateRequest $request, $id) {
        $maxioRequest = $this->maxioRequest('PUT', 'subscriptions/'.$id.'.json', $request->all());

        $message = 'Subscription updated successfully.';

        return $this->response($maxioRequest, $message);
    }
}
