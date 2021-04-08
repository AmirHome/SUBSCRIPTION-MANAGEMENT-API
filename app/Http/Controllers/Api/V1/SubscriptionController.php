<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Device;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {

        $response =  Http::timeout(30)
                            ->asForm()
                            ->post('http://tek.loc/api/mock/google/verification',
                                ['receipt' => $request->input('receipt')]
                              )
                            ->throw(function ($response, $e) {
                                return response()->json([
                                    'status' => false,
                                    'error' => $e,
                                ]);
                            })
                    ;
        if($response->successful()){
            if ($response->json('status')){

                $expireDate = $response->json('expire_date');

                $data = ['device_id' => $request->user()->id, // Retrieve Device ID by Token
                         'receipt' => $request->input('receipt'),
                         'status' => true,
                         'expire_date' => $expireDate ,
                        ];

                $request = new StoreSubscriptionRequest($data);
                $validator = Validator::make($data, $request->rules());
                if ($validator->fails()) {
                    return $validator->errors();
                }
                $dataKeys = $validator->validated();
                $data = array_splice($dataKeys,2);

                $subscription = Subscription::updateOrCreate($dataKeys, $data);
                return (new SubscriptionResource($subscription))
                    ->response()
                    ->setStatusCode(Response::HTTP_CREATED);
            }
        }
    }

    public function view(Request $request) {

        $deviceId = $request->user()->id; // Retrieve Device ID by Token

        $device = Device::where('id', $deviceId)->with('subscription')->first();

        $subscription = ['device_id' => $deviceId,
            'receipt' => $device->subscription->receipt,
            'status' => $device->subscription->status,
            'expire_date' => $device->subscription->expire_date ,
        ];

        return (new SubscriptionResource($subscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
