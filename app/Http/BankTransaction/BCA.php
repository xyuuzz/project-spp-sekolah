<?php

namespace App\Http\BankTransaction;

use Illuminate\Support\Facades\Http;

class BCA
{
    protected $domain = "https://sandbox.bca.co.id",
            $clientId = "a8c52b2e-83d0-4f58-9fdb-93cffdba779b",
            $clientSecret = "a08e19ee-2ba0-4933-a12a-6ee38d50e215",
            $apiKey = "82a0cb90-0d42-4fad-8866-4a6d8e5b9d45",
            $apiSecret = "5cbe9314-ded4-4f69-8158-9dcc6c54c2a4",
            $timestamp, $accessToken;

    public function __construct(protected $no_rek = '', protected $an_rek = '')
    {
        $this->accessToken = $this->getAccessToken();
        $this->timestamp = date("Y-m-d\TH:i:s.000P");
    }

    protected function getAccessToken()
    {
        $path = "/api/oauth/token";
        $token = base64_encode($this->clientId . ":" . $this->clientSecret);

        $data = [
            "grant_type" => "client_credentials",
        ];

        $response = Http::asForm()->withToken($token, "Basic")
                    ->post($this->domain . $path, $data);

        // jika response sukses, maka decode json, lalu akses property access_token pada json tsb.
        return $response->successful() ? json_decode($response)->access_token
                                    : abort(401, json_decode($response)->ErrorMessage->Indonesian);
    }

    // request hmac signature numbers
    protected function signature($method, $pathRequest, $body = '', $contentType = "text/plain")
    {
        $path = "/utilities/signature/";

        $headers = [
            "URI" => $pathRequest, // path url
            "Timestamp" => $this->timestamp,
            "APISecret" => $this->apiSecret,
            "HTTPMethod" => $method,
            "AccessToken" => $this->accessToken // access token / barear token
        ];

        $response = Http::withHeaders($headers)
                            ->withBody($body, $contentType)
                            ->post($this->domain . $path);

        // jika response berhasil, maka explode string response nya dan kembalikan index terakhir dari array tsb.
        if($response->successful()) {
            $result_array = explode(": ", $response->body());
            return last($result_array);
        } else {
            abort(401, json_decode($response)->ErrorMessage->Indonesian);
        }
    }

    public function tfAntarBca()
    {
        $path = "/banking/corporates/transfers";

        $body = [
            "transaction_id" => "00000001",
            "transaction_date" => "2016-01-30",
            "source_account_number" => "0201245680",
            "beneficiary_account_number" => "0201245681",
            "beneficiary_bank_code" => "BRINIDJA",
            "beneficiary_name" => "Tester",
            "amount" => "100000.00",
            "transfer_type" => "LLG",
            "beneficiary_cust_type" => "1",
            "beneficiary_cust_residence" => "1",
            "currency_code" => "IDR",
            "remark1" => "Transfer Test",
            "remark2" => "Online Transfer",
            "beneficiary_email" => "test@123.com"
        ];

        $headers = [
            "X-BCA-Key" => $this->apiKey,
            "X-BCA-Timestamp" => $this->timestamp,
            "X-BCA-Signature" => $this->signature("POST", $path, json_encode($body), "application/json")
        ];

        $response = Http::asJson()
                    ->withToken($this->accessToken)
                    ->withHeaders($headers)
                    ->post($this->domain . $path, $body);

        if($response->successful()) {
            dd(json_decode($response), $response);
        } else {
            dd(json_decode($response), "gagal");
        }
    }

    public function createTransactionVA()
    {
        $link = "https://api.klikbca.com/va/transfer";

        $headers = [
            'channel-id' => '95051',
            'credential-id' =>  'KBBTESTTES'
        ];
        $body = [
            "transaction_id" => "12345678",
            "transaction_date" => "2020-12-31",
            "source_account_number" => "2011101231",
            "customer_number" => "12345678901234567890123",
            "amount" => 200000.00,
            "currency" => "IDR",
            "beneficiary_email_address" => "test123@bca.co.id"
        ];

        $response = Http::asJson()->withHeaders($headers)
                    ->post($link, $body);
        dd(json_decode($response));
    }

    public function ceksaldo($startDate, $endDate)
    {
        $path = "/banking/v3/corporates/BCAAPI2016/accounts/0201245680/statements?StartDate={$startDate}&EndDate={$endDate}";

        $headers = [
            "X-BCA-Key" => $this->apiKey,
            "X-BCA-Timestamp" => $this->timestamp,
            "X-BCA-Signature" => $this->signature("GET", $path)
        ];

        $response = Http::withToken($this->accessToken)
                        ->withHeaders($headers)
                        ->get($this->domain . $path);

        dd(json_decode($response));
    }

    public function createPaymentSakuku()
    {
        $path = "/sakuku-commerce/payments";

        $body = [
            "MerchantID" => "89000",
            "MerchantName" => "SPP Sekolah",
            "Amount" => "250000.00",
            "Tax" => "0.0",
            "TransactionID" => "221178",
            "CurrencyCode" => "IDR",
            "RequestDate" => $this->timestamp,
            "ReferenceID" => "99977234"
        ];
        
        $headers = [
            "X-BCA-Key" => $this->apiKey,
            "X-BCA-Timestamp" => $this->timestamp,
            "X-BCA-Signature" => $this->signature("POST", $path, json_encode($body), "application/json")
        ];

        $response = Http::asJson()->withHeaders($headers)
                    ->withToken($this->accessToken)
                    ->post($this->domain . $path, $body);

        dd(json_decode($response));
    }

    public function checkTransactionSakuku()
    {
        $merchantId = null;
        $paymentId = null;

        $path = "/sakuku-commerce/payments/{$merchantId}/{$paymentId}";

        $headers["X-BCA-Signature"] = $this->signature("GET", $path);

        $response = Http::asJson()->withHeaders($headers)
                    ->withToken($this->accessToken)
                    ->get($this->domain . $path);
        dd(json_decode($response));
    }
}


