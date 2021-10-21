<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

class BayarSpp extends Component
{
    public $cara_pembayaran, $statusPembayaran, $an, $bukti, $no_rek;

    public function mount($statusPembayaran)
    {
        $this->statusPembayaran = $statusPembayaran;
        $this->cara_pembayaran = "tf_antar_bri";
    }

    public function render()
    {
        return view('livewire.bayar_spp.bayar-spp');
    }

    public function submitPembayaranSpp()
    {
        // $this->validate();
        $barear_token_bri = $this->bri_barear_token();
        // $this->tf_antar_bri($barear_token_bri);
        $this->create_briva($barear_token_bri);
    }

//    method untuk mencetak struk pembayaran untuk siswa
    public function cetak_struk()
    {
        $pdf = PDF::loadView("template_pdf.struk_pembayaran_untuk_siswa")->setPaper("A4", "potrait");
        return $pdf->stream("Uji Coba.pdf");
    }

    public function resetValue()
    {
        $this->reset(["no_rek", "an", "bukti"]);
    }

    protected function bri_barear_token()
    {
        try {
            $data = [
                "client_id" => "wwwY2I540ngOrI3yEmNe0YH5IHK66MgI",
                "client_secret" => "7sqGvPvGAqiUORYA"
            ];

            $response = Http::asForm()->post("https://sandbox.partner.api.bri.co.id/oauth/client_credential/accesstoken?grant_type=client_credentials", $data);

            $bearer_token = json_decode($response->getBody()->getContents())->access_token;
        } catch(ClientException $e) {
            dd(Message::toString($e->getRequest()), Message::toString($e->getResponse()));
            abort(401, "Maaf, Server BRI Sedang Error!");
        }

        return $bearer_token;
    }

    protected function signature_bri($path, $verb, $bearer_token, $timestamp, $secret_key, $body='')
    {
        $payload = "path={$path}&verb={$verb}&token=Bearer {$bearer_token}&timestamp={$timestamp}&body={$body}";
        $signature = base64_encode(hash_hmac("sha256", $payload, $secret_key, TRUE));
        return $signature;

        // dd($path, $verb, $bearer_token, $timestamp, json_encode($body), $payload, $signature, strlen("1VJ1T9Gndw2AYV2DZIaJDMptdMWKNWAOEXiM+Mb+9nk="));
    }

    public function tf_antar_bri($bearer_token)
    {
        try {
            date_default_timezone_set("UTC");
            $timestamp = date('Y-m-d\TH:i:s.') . random_int(100, 800) . "Z";

            $body = [
                "sourceAccount" => "020601000255504",
                "beneficiaryAccount" => "020601000003333"
            ];

            $signature = $this->signature_bri("/v3.1/transfer/internal/accounts", "POST", $bearer_token, $timestamp, "7sqGvPvGAqiUORYA", json_encode($body));

            $headers = [
                "BRI-Timestamp" => "$timestamp",
                "BRI-Signature" => $signature,
            ];

            $response = Http::acceptJson()->withToken($bearer_token)
                        ->withHeaders($headers)
                        ->post("https://sandbox.partner.api.bri.co.id/v3.1/transfer/internal/accounts", $body);

            dd(json_decode($response));
        } catch(ClientException $e) {
            dd($e->getMessage());
        }
    }

    protected function create_briva($bearer_token)
    {
        try {
            date_default_timezone_set("UTC");
            $timestamp = date('Y-m-d\TH:i:s.') . random_int(100, 800) . "Z";

            $body = [
                "institutionCode" => "J104408",
                "brivaNo" => "77777",
                "custCode" => "881323718321",
                "nama" => "Maulana Yusuf",
                "amount" => "200000",
                "keterangan" => "Membayar Pajak Bulanan",
                "expiredDate" => "2021-10-26 09:57:26"
            ];

            $signature = $this->signature_bri("/v1/briva", "POST", $bearer_token, $timestamp, "7sqGvPvGAqiUORYA", json_encode($body));

            $headers = [
                "BRI-Timestamp" => $timestamp,
                "BRI-Signature" => $signature,
            ];

            $response = Http::acceptJson()->withToken($bearer_token)
                        ->withHeaders($headers)
                        ->post("https://sandbox.partner.api.bri.co.id/v1/briva", $body);

            dd(json_decode($response));
        } catch(ClientException $e) {
            dd($e->getMessage());
        }
    }
}
