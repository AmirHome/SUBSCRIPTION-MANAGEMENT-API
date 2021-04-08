<?php


namespace App\Http\Requests;


use App\Models\Device;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class MockReceiptVerificationRequest extends FormRequest
{


    public function rules()
    {
        return [
            'receipt' => [
                'required',
            ],
        ];
    }
}
