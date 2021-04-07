<?php

namespace App\Http\Controllers\Mock;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GoogleReceiptVerificationController extends Controller
{

    public function verification (Request $request){

        $receipt = $request->input('receipt');

        $lastNo = (int) substr($receipt, -1);


        if ($lastNo % 2 != 0) {
            $result = ['status'=>true, 'expire_date'=> Carbon::now()->setTimezone('UTC')->addMonth(1)->format('Y-m-d H:i:s')];

        } else {
            $result = ['status'=>false];
        }
        sleep(1);
        return response()->json($result, 200);
    }

}
