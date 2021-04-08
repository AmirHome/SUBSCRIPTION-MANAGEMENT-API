<?php


namespace App\Helper;


use Illuminate\Support\Facades\Http;

class Helper
{

    public static function mockGoogleVerification($receipt){
        return Http::timeout(30)
            ->asForm()
            ->post('http://tek.loc/api/mock/google/verification',
                ['receipt' => $receipt]
            )
            ->throw(function ($response, $e) {
                return response()->json([
                    'status' => false,
                    'error' => $e,
                ]);
            })
        ;
    }
}
