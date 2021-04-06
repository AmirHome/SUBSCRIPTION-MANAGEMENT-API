<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Models\Device;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeviceController extends Controller
{

    public function store(StoreDeviceRequest $request)
    {
        $device = Device::create($request->validated());

        $token = $device->createToken('auth-token')->plainTextToken;

        return (new DeviceResource($device))
                ->passToken([$token])
                ->response()
                ->setStatusCode(Response::HTTP_CREATED);
    }

}
