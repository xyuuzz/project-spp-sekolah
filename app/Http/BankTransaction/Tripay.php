<?php

namespace App\Http\BankTransaction;

use Illuminate\Support\Facades\Http;

class Tripay
{
    private $apiKey = "DEV-r83mUcfV5ypwdbKGhEqnf0nllI4yPzgw79E5cmBH",
                $domain = "https://tripay.co.id",
                $privateKey = 'wPh0N-RbCJz-vnKBA-HkiSb-lvaxg',
                $merchantCode = 'T7435',
                $merchantRef;

    public function __construct(protected $amount = 0, protected $class = 0)
    {
        $this->merchantRef = "PAY-" . time();
    }

    protected function signature()
    {
        $string = $this->merchantCode . $this->merchantRef . $this->amount;
        $signature = hash_hmac("sha256", $string, $this->privateKey);

        return $signature;
    }

    public static function mapPaymentList($paymentList)
    {
        $payment = [
            "BRIVA",
            "BCAVA",
            "BNIVA",
            "CIMBVA",
            "ALFAMART",
            "INDOMARET",
            "ALFAMIDI",
            "QRISC"
        ];

        $image = [
            "BRIVA" => "https://www.linkaja.id//uploads/images//YW50aWtvZGVfXzE2MDEwOTA0OTRfYnJpLWJyYXZhLTA3LXBuZw.png",
            "BCAVA" => "https://www.jagoanhosting.com/wp-content/uploads/2020/11/Payment-BCA.jpg",
            "BNIVA" => "https://idalamat.com/images/addresses/4111342-bni-pangkal-pinang--kantor-cabang-kab-bangka-kepulauan-bangka-belitung.png",
            "CIMBVA" => "https://upperline.id/uploads/images/image_750x_5eb4e040af41a.jpg",
            "ALFAMART" => "https://cdn.kibrispdr.org/data/alfamart-logo-vector-1.jpg",
            "INDOMARET" => "https://asset.kompas.com/crops/Td_1JSiinZCF20v82hgOVeleNjM=/0x57:960x697/750x500/data/photo/2021/05/23/60aa007d1cabb.jpg",
            "ALFAMIDI" => "https://statik.tempo.co/data/2017/02/21/id_583410/583410_620.jpg",
            "QRISC" => "https://asset.kompas.com/crops/HlE36NS1jXyjpDoB2EB3_DaWg7U=/0x0:780x520/750x500/data/photo/2020/11/05/5fa4006d6dbde.jpg"
        ];

        $result = [];
        foreach($paymentList as $data)
        {
            if(is_int(array_search($data["code"], $payment)))
            {
                $data["cover"] = $image[$data["code"]];
                array_push($result, $data);
            }
        }

        return $result;
    }

    public function createTransaction($method)
    {
        $path = "/api-sandbox/transaction/create";

        $body = [
            "method"            => $method,
            "merchant_ref"      => $this->merchantRef,
            "amount"            => $this->amount,
            "customer_name"     => $this->class . "-" . auth()->user()->name,
            "customer_email"    => auth()->user()->email,
            "customer_phone"    => auth()->user()->profile->phone->phone_number,
            'order_items'       => [
                [
                  'sku'         => 'SPP Siswa',
                  'name'        => 'Pembayaran SPP Siswa',
                  'price'       => $this->amount,
                  'quantity'    => 1
                ]
            ],
            'expired_time'      => (time()+( (24*60*60) *1 )), // 1 Hari
            "signature"         => $this->signature()
        ];

        $response = Http::withToken($this->apiKey)->post($this->domain . $path, $body);

        $result = $response->json();
        return $result;
        // if($result["success"])
        // {
        //     dd("mantab", $result);

        //     // jika berhasil maka buat qr code yang berisi data pesanan tersebut
        // }
        // else
        // {
        //     dd("error bang", $result);
        // }
    }


    public function calculatePaymentList($amount)
    {
        $path = "/api-sandbox/merchant/fee-calculator";

        // $response = Http::async()->withToken($this->apiKey)->get($this->domain . $path, compact("amount"));
        $response = Http::withToken($this->apiKey)->get($this->domain . $path, compact("amount"));
        return $response;
    }

    public function detailTransaction()
    {
        $path = "/api-sandbox/transaction/detail";

        $body = [
            "reference" => "asal aja dulu, nanti req ke db" // nilai dari reference adalah kode unik dari pesanan yang akan diminta detailnya.
        ];

        $response = Http::withToken($this->apiKey)->get($this->domain . $path, $body);

        if($response->json()["success"])
        {
            dd("mantab", $response->json());
        }
        else
        {
            dd("error bang", $response->json());
        }
    }

}
