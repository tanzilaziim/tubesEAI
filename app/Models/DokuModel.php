<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DokuModel extends Model
{
    use HasFactory;

    public static function generateSignature($headers, $targetPath, $body, $secret)
    {
        $digest = base64_encode(hash('sha256', $body, true));
        $rawSignature = "Client-Id:" . $headers['Client-Id'] . "\n"
            . "Request-Id:" . $headers['Request-Id'] . "\n"
            . "Request-Timestamp:" . $headers['Request-Timestamp'] . "\n"
            . "Request-Target:" . $targetPath . "\n"
            . "Digest:" . $digest;

        $signatureHmac = hash_hmac('sha256', $rawSignature, $secret, true);
        $signatureBase64 = base64_encode($signatureHmac);
        return 'HMACSHA256=' . $signatureBase64;
    }

    function checkout($order, $orderDetail, $trxCode)
    {
        $dokuUrl = env('DOKU_URL');
        $callbackUrl = env('CALLBACK_URL');
        $merchantId = env('DOKU_MERCHANT_ID');
        $expiredTime = env('EXPIREDTIME');
        $secretKey = env('DOKU_SECRET_KEY');
        $payCode = "INV-" . date('YmdHis');
    
        $targetUrl = "/checkout/v1/payment";
        $requestId = Uuid::uuid4()->toString();
        $requestTimestamp = Carbon::now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
    
        $header = [
            "Client-Id" => $merchantId,
            "Request-Id" => $requestId,
            "Request-Timestamp" => $requestTimestamp,
            "Content-Type" => "application/json",
        ];
    
        $body = [
            "order" => [
                "amount" => $order->total_price, 
                "invoice_number" => $payCode,
                "currency" => "IDR",
                "session_id" => uniqid("SESSION_", true),
                "callback_url" => $callbackUrl,
                "line_items" => $orderDetail,
            ],
            "payment" => [
                "payment_due_date" => $expiredTime,
            ],
            "customer" => [
                "name" => $order->name,
                "email" => $order->email,
                "phone" => $order->phone_number,
                "address" => $order->address,
                "country" => $order->country,
            ],
        ];
    
        $bodyRequest = json_encode($body);
    
        $signature = $this->generateSignature($header, $targetUrl, $bodyRequest, $secretKey);
        $headers = [
            'Client-Id: ' . $merchantId,
            'Request-Id: ' . $requestId,
            'Request-Timestamp: ' . $requestTimestamp,
            'Signature: ' . $signature,
            'Content-Type: application/json',
        ];
    
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $dokuUrl . $targetUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $bodyRequest,
            CURLOPT_HTTPHEADER => $headers,
        ]);
    
        $response = curl_exec($curl);
        curl_close($curl);
    
        $this->storeLog($trxCode, 'Payment', $bodyRequest, $response);
    
        return json_decode($response, true);
    }
    

    function checkStatus($trxCode, $payCode)
    {
        $dokuUrl = env('DOKU_URL');
        $merchantId = env('DOKU_MERCHANT_ID');
        $secretKey = env('DOKU_SECRET_KEY');

        $targetUrl = "/orders/v1/status/";
        $requestId = Uuid::uuid4()->toString();
        $requestTimestamp = Carbon::now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');

        $header = [
            "Client-Id" => $merchantId,
            "Request-Id" => $requestId,
            "Request-Timestamp" => $requestTimestamp
        ];

        $rawSignature = "Client-Id:" . $header['Client-Id'] . "\n"
            . "Request-Id:" . $header['Request-Id'] . "\n"
            . "Request-Timestamp:" . $header['Request-Timestamp'] . "\n"
            . "Request-Target:" . $targetUrl . $payCode;

        $signatureHmac = hash_hmac('sha256', $rawSignature, $secretKey, true);
        $signatureBase64 = base64_encode($signatureHmac);
        $signature = 'HMACSHA256=' . $signatureBase64;

        $headers = [
            'Client-Id: ' . $merchantId,
            'Request-Id: ' . $requestId,
            'Request-Timestamp: ' . $requestTimestamp,
            'Signature: ' . $signature
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $dokuUrl . $targetUrl . $payCode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $this->storeLog($trxCode, 'Check_Status', "", $response);

        return json_decode($response, true);
    }

    function storeLog($trxCode, $reqType, $request, $response)
    {
        DB::table('log_payment')
            ->insert([
                'trx_code'  => $trxCode,
                'req_type'  => $reqType,
                'request'   => $request,
                'response'  => $response,
            ]);

        return true;
    }
}
