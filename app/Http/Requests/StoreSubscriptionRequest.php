<?php


namespace App\Http\Requests;


use App\Models\Device;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubscriptionRequest extends FormRequest
{


    public function rules()
    {
        return [
            'device_id' => [
                'integer',
                'required',
            ],
            'receipt'    => [
                'required',
            ],
            'status'  => [
                'integer',
                'required',
            ],
            'expire_date'     => [
                'date',
                'required',
            ],
        ];
    }

}
