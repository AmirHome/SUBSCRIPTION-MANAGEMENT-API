<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    protected $token;

    public function passToken($value){
        $this->token = $value;
        return $this;
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($token)
    {
        return [
            'client_token' => $this->token,
        ];
    }

}
