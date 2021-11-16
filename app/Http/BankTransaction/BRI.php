<?php

namespace App\Http\BankTransaction;

use Illuminate\Support\Facades\Http;

class BRI
{
    protected $domain="https://sandbox.partner.api.bri.co.id",
    $client_id = "wwwY2I540ngOrI3yEmNe0YH5IHK66MgI",
    $client_secret = "7sqGvPvGAqiUORYA";

    public function __construct(protected $no_rek = '', protected $an_rek = '')
    {
        date_default_timezone_set("UTC");
    }

    protected function bearer_token()
    {
        $path = "/oauth/client_credential/accesstoken?grant_type=client_credentials";
        $data = [
            "client_id" => $this->client_id,
            "client_secret" => $this->client_secret
        ];

        $response = Http::asForm()->post($this->domain . $path, $data);

        return $response->successful() ? json_decode($response)->access_token
                                    : abort(401, "Maaf, Server BRI Sedang Error!");
    }

    protected function signature_bri($path, $verb, $bearer_token, $timestamp, $secret_key, $body='')
    {
        $payload = "path={$path}&verb={$verb}&token=Bearer {$bearer_token}&timestamp={$timestamp}&body={$body}";

        $signature = base64_encode(hash_hmac("sha256", $payload, $secret_key, TRUE));

        return $signature;
    }

    public function tf_antar_bri()
    {
        $path = "/v3.1/transfer/internal/accounts";
        $bearer_token = $this->bearer_token();
        $timestamp = date('Y-m-d\TH:i:s.') . random_int(100, 800) . "Z";

        $body = [
            "sourceAccount" => $this->no_rek,
            "beneficiaryAccount" => '' . env("REK_SEKOLAH", "00138219371918")
        ];

        $signature = $this->signature_bri($path, "POST", $bearer_token, $timestamp, $this->client_secret, json_encode($body));

        $headers = [
            "BRI-Timestamp" => "$timestamp",
            "BRI-Signature" => $signature,
        ];

        $response = Http::acceptJson()->withToken($bearer_token)
                    ->withHeaders($headers)
                    ->post("{$this->domain}{$path}", $body);

        if($response->successful()) {
            dd(json_decode($response));
        } else {
            dd(json_decode($response), "ERROR");
        }
    }

    public function create_briva()
    {
        $path = "/v1/briva";
        $timestamp = date('Y-m-d\TH:i:s.') . random_int(100, 800) . "Z";
        $bearer_token = $this->bearer_token();

        $body = [
            "institutionCode" => "J104408",
            "brivaNo" => "77777",
            "custCode" => "881323718321",
            "nama" => "Maulana Yusuf",
            "amount" => "200000",
            "keterangan" => "Membayar Pajak Bulanan",
            "expiredDate" => "2021-10-26 09:57:26"
        ];

        $signature = $this->signature_bri($path, "POST", $bearer_token, $timestamp, $this->client_secret,
        json_encode($body));

        $headers = [
            "BRI-Timestamp" => $timestamp,
            "BRI-Signature" => $signature,
        ];

        $response = Http::acceptJson()->withToken($bearer_token)
                    ->withHeaders($headers)
                    ->post("{$this->domain}{$path}", $body);

        if($response->successful()) {
            dd(json_decode($response));
        } else {
            dd(json_decode($response), "ERROR");
        }
    }
}

