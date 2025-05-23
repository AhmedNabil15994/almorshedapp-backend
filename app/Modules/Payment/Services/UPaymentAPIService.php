<?php

namespace App\Modules\Payment\Services;

use App\Modules\Services\Models\Service;

class UPaymentAPIService
{

    public function send($request)
    {
        return $this->newUPayment($request);
    }

    ######################## Start New UPayment ###########################

    public function newUPayment($request)
    {
        if (!function_exists('curl_version')) {
            exit ("Enable cURL in PHP");
        }

        $service = Service::find($request->service_id);

        $lang = (locale() == 'ar') ? 1 : 2;
        $mobile = auth()->user()->mobile ? auth()->user()->mobile : null;
        $email = auth()->user()->email ? auth()->user()->email : null;
        $name = auth()->user()->name ? auth()->user()->name : null;
        $id = auth()->id() ? auth()->id() : null;

        $fields = array(
            'merchant_id' => config('services.upayments.merchant_id'),
            'username' => config('services.upayments.username'),
            'password' => stripslashes(config('services.upayments.password')),
            'api_key' => config('services.upayments.test_mode')
                ? config('services.upayments.api_key')
                : password_hash(config('services.upayments.api_key'), PASSWORD_BCRYPT), // in sandbox request
            //'api_key' =>password_hash('API_KEY',PASSWORD_BCRYPT), //In production mode, please pass API_KEY with BCRYPT function
            'order_id' => $request->transaction_id, // MIN 30 characters with strong unique function (like hashing function with time)

            'total_price' => $request->price,
            'CurrencyCode' => 'KWD',//only works in production mode

            'CstFName' => $name,
            'CstEmail' => $email,
            'CstMobile' => $mobile,

            'success_url' => route('api.checkout.payment-success'),
            'error_url' => route('api.checkout.payment-failed'),
            'notifyURL' => route('api.checkout.upayments-webhook'),

            'test_mode' => config('services.upayments.api_key'), // test mode enabled
            'whitelabled' => config('services.upayments.whitelabled'), // only accept in live credentials (it will not work in test)
            'payment_gateway' => 'knet',// only works in production mode
            'ProductName' => $service ? $service->name : '',
            /*'ProductQty' => json_encode([2, 1]),
            'ProductPrice' => json_encode([150, 1500]),*/
            'reference' => 'Ref'.$request->transaction_id,
        );
        $fields_string = http_build_query($fields);

//        $ApiCustomFileds = "doctor_id='.$request->doctor_id.',user_id='.$request->user_id.',price='.$request->price.',service_id='.$request->service_id.',date='.$request->date.',start_time='.$request->start_time.',end_time='.$request->end_time.',availability_id='.$request->availability_id.'";
//        dd($ApiCustomFileds, $fields, $fields_string);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('services.upayments.url')); /*PAY_PRODUCTION_URL*/
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        return $server_output;
    }

    ########################## End New UPayment ###########################
}
