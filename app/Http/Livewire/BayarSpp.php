<?php

namespace App\Http\Livewire;

use App\Http\BankTransaction\{BRI as BRIPayment, BCA as BCAPayment, Tripay};
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Http\Trait\DynamicMethod;

class BayarSpp extends Component
{
    use DynamicMethod;

    public $cara_pembayaran,
            $statusPembayaran,
            $an,
            $bukti,
            $no_rek,
            $class,
            $tripayPaymentList,
            $pembayaran,
            $tripayPaymentPicked;

    public function mount($statusPembayaran, $pembayaran)
    {
        $this->pembayaran = $pembayaran;
        $this->tripayPaymentList = [];

        $this->statusPembayaran = $statusPembayaran;
        $this->cara_pembayaran = "tripay";

        $this->class = auth()->user()->profile->class->class;

        if($statusPembayaran === null)
        {
            $tripay = new Tripay();
            $resultPaymentList = $tripay->calculatePaymentList($this->class->biaya_spp)->json()["data"];
            $this->tripayPaymentList = $tripay->mapPaymentList($resultPaymentList);
        }
    }

    public function render()
    {
        return view('livewire.bayar_spp.bayar-spp');
    }

    public function submitPembayaranSpp()
    {
        // membuat var hasil transaksi yang bernilai false
        $transactionResult = false;

        // list pembayaran yang dilakukan tanpa menggunakan no rekening
        $withoutNoRek = ['sakuku', 'bca_va', 'bni_va', "briva", "tripay"];

        $valNoRek = array_search($this->cara_pembayaran, $withoutNoRek) === false ? "required" : "nullable";
        $valBuktiNoRek = $this->cara_pembayaran === "manual" ? "required" : "nullable";
        $valTripay = $this->cara_pembayaran === "tripay" ? "required" : "nullable";

        $data = $this->validate([
            "an" => "$valNoRek|string|required_if:bukti,TRUE", // atas nama
            "bukti" => "$valBuktiNoRek|image|max:1024|mimes:png,jpg,jpeg", // bukti pembayaran
            "no_rek" => "$valBuktiNoRek|integer", // nomor rekening
            "tripayPaymentPicked" => "$valTripay|string", // pembayaran tripay
        ], [
            "an.required" => "Diisi Oleh Pemilik Nomor Rekening dengan <b>Huruf Kapital</b>",
            "an.string" => "Mohon menulis nama dengan benar",
            "bukti.max" => "Maximal Gambar yang di unggah adalah ukuran 1MB",
            "bukti.mimes" => "File yang anda unggah tidak didukung oleh siswa ini",
            "bukti.image" => "File yang diunggah harus berbentuk Image/ Gambar",
            "no_rek.integer" => "Hanya boleh memasukan angka pada Kolom Rekening",
            "no_rek" => "Minimal 10 angka"
        ]);

        // isi variabel next dengan value dari indeks dari value cara_pembayaran pada variabel withoutNoRek. Jika hasilnya lebih dari = 0, maka TRUE jika tida maka FALSE
        if(! $next = array_search($this->cara_pembayaran, $withoutNoRek) >= 0 )
        {
            $bank = explode("_", $this->cara_pembayaran);

            $request_status_rek = Http::post("https://cekrekening.id/master/cekrekening/report", [
                "bankId" => $this->getBankId(end($bank)),
                "bankAccountNumber" => $this->no_rek
            ]);

            $status_rek = $request_status_rek?->successful()
                            ? $request_status_rek->json()["status"] : false;

            // nilai dari var next = status rek
            $next = $status_rek;
        }

        // jika var next bernilai TRUE maka lanjut, jika FALSE maka gagal
        if($next)
        {
            if($this->cara_pembayaran === "tf_antar_bri")
            {
                $bri = new BRIPayment($data["no_rek"], $data["an"]);
                $response = $bri->tf_antar_bri();
                dd($response);
            }
            elseif($this->cara_pembayaran === "briva")
            {
                $bri = new BRIPayment($data["no_rek"], $data["an"]);
                $response = $bri->tf_antar_bri();
                dd($response);
            }
            elseif($this->cara_pembayaran === "tripay")
            {
                $tripay = new Tripay($this->class->biaya_spp, $this->class->class);
                // dd(strtoupper($this->tripayPaymentPicked));
                $result = $tripay->createTransaction( strtoupper($this->tripayPaymentPicked) );
                // dd($result);
                if($result["success"])
                {
                    auth()->user()->spp_transaction()->create([
                        "link_pembayaran" => $result["data"]["checkout_url"],
                        "amount" => $result["data"]["amount"],
                        "pay_code" => $result["data"]["pay_code"] ?? $result["data"]["reference"],
                        "status" => 0,
                        "kadaluarsa" => now("Asia/Jakarta")->addDay(),
                        "qr_code" => $result["data"]["qr_url"] ?? null
                    ]);

                    redirect( route("student") . "#bayarspp")->with("success", "Berhasil Membuat Transaksi, Silahkan lunasi dengan batas maximal adalah <b>1 hari</b>");
                    // session()->flash();
                }
                else
                {
                    session()->flash("failed", "Gagal membuat transaksi! Coba lagi dilain waktu!");
                }
            }

            // stop here

            // cek apakah pembayaran yang dilakukan berhasil
            if($transactionResult)
            {
                // panggil fungsi cetak struk karena pembayaran berhasil
            }
        }
        else
        {
            dd("gagal:(");
        }

        $this->reset(["no_rek", "an", "bukti"]);
    }

//    method untuk mencetak struk pembayaran untuk siswa
    public function cetak_struk()
    {
        // kelas PDF adalah class alias dari Barryvdh\DomPDF\Facade
        $pdf = PDF::loadView("template_pdf.struk_pembayaran_untuk_siswa")->setPaper("A4", "potrait");
        return $pdf->stream("Uji Coba.pdf");
    }

    // ketika user pindah metode pembayaran, maka method ini akan dipanggil
    public function resetValue()
    {
        $this->reset(["no_rek", "an", "bukti", "tripayPaymentPicked"]);

        // explode cara pembayaran dan akses value pertama, jika nilai nya tripay dan user belum memilih metode apa yang akan digunakan, maka nilai = TRUE
        // if(explode("_", $this->cara_pembayaran)[0] === "tripay" && ! count($this->tripayPaymentList))
        // {
        //     Tripay::calculatePaymentList($this->class->biaya_spp)
        //     ->then(function(Response|TransferException $result) {
        //         $this->tripayPaymentList = Tripay::mapPaymentList($result->json()["data"]);
        //     })->wait();
        //     // $this->tripayPaymentList = Tripay::paymentList($this->class->biaya_spp);
        // }
    }

    public function setTripayPayment($jenis)
    {
        $this->tripayPaymentPicked = $jenis;
    }

    private function getBankId($bank)
    {
        switch ( strtoupper($bank) ) {
            case 'BRI':
                return 1;
                break;
            case 'MANDIRI':
                return 2;
                break;
            case 'MEGA':
                return 3;
                break;
            case 'BCA':
                return 4;
                break;
            case 'BNI':
                return 5;
                break;
            default:
                return false;
                break;
        }
    }

}
