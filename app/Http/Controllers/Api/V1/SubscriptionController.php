<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Device;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {

        $response = Helper::mockGoogleVerification($request->input('receipt'));

        if ($response->successful()) {
            if ($response->json('status')) {

                $data = ['device_id' => $request->user()->id, // Retrieve Device ID by Token
                    'receipt' => $request->input('receipt'),
                    'status' => 'started',
                    'expire_date' => $response->json('expire_date'),
                ];

                $data = $this->validateData($data);

                $subscription = $this->updateOrCreateSubscription($data);

                return (new SubscriptionResource($subscription))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
            }
        }
    }

    public function view(Request $request)
    {

        $deviceId = $request->user()->id; // Retrieve Device ID by Token

        $device = Device::where('id', $deviceId)->with('subscription')->first();

        $subscription = ['device_id' => $deviceId,
            'receipt' => $device->subscription->receipt,
            'status' => $device->subscription->status,
            'expire_date' => $device->subscription->expire_date,
        ];

        return (new SubscriptionResource($subscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function validateData($data)
    {
        $request = new StoreSubscriptionRequest($data);
        $validator = Validator::make($data, $request->rules());
        if ($validator->fails()) {
            return $validator->errors();
        }
        return $validator->validated();
    }

    public function updateOrCreateSubscription($data): Subscription
    {
        $values = array_splice($data, 2);
        return Subscription::updateOrCreate($data, $values);
    }
}
