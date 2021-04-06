<?php


namespace App\Http\Requests;


use App\Models\Device;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDeviceRequest extends FormRequest
{


    public function rules()
    {
        return [
            'u_id' => [
                'integer',
                'required',
            ],
            'app_id'    => [
                'integer',
                'required',
            ],
            'lang'  => [
                'string',
                'required',
            ],
            'os'     => [
                'string',
                'required',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->replace([
            'u_id' => $this->uID,
            'app_id' => $this->appID,
            'lang' => $this->lang,
            'os' => $this->os,
        ]);
    }
}
