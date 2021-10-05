<?php

namespace App\Exports;

use App\Models\StudentPayment;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\{FromCollection, Exportable, ShouldAutoSize, WithHeadings, WithTitle};

class DownloadSppExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    use Exportable;

//    file name
    private $fileName = 'Daftar Pembayaran SPP Siswa.xlsx';

//    type / extensi file
    private $writerType = Excel::XLSX;

//    header file
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            "No",
            "Nama",
            "Jenis Kelamin",
            "Email",
            "No. Rekening",
            "Kelas",
            "Biaya Pembayaran",
            "No. Handphone",
            "Tanggal Pembayaran",
        ];
    }

    public function forYear($year)
    {
        $this->year = $year;
        return $this;
    }

    public function forMonth($month)
    {
        $this->month = $month;
        return $this;
    }

    public function title(): string
    {
        $date = date("F", mktime(0,0,0, $this->month, 10));
        return "Bulan: {$date}";
    }

    public function collection()
    {
        return StudentPayment::query()
                             ->whereMonth("created_at", $this->month)
                             ->whereYear("created_at", $this->year)
                             ->get()
                             ->map( fn($payment, $key) => $this->mapping_field($payment, $key) );
    }

    private function mapping_field($payment, $key): array
    {
        return [
            "No" => $key+1,
            "Nama" => $payment->profile->user->name,
            "Jenis Kelamin" => $payment->profile->user->gender,
            "Email" => $payment->profile->user->email,
            "No. Rekening" => $payment->no_rek,
            "Kelas" => $payment->profile->class->class->class,
            "Biaya Pembayaran" => "Rp. " . number_format($payment->profile->class->class->biaya_spp, 0, ',', '.'),
            "No. Handphone" => $payment->profile->phone->phone_number,
            "Tanggal Pembayaran" => $payment->created_at->format("l, d-F-Y"),
        ];
    }
}
