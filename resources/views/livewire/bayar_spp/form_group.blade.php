@if($cara_pembayaran === "tf_antar_bri")
    <div class="form-group">
        <label for="no_rek">No. Rekening Bank (BRI)</label>
        <input wire:model="no_rek" id="no_rek" type="number" class="form-control">
        <div class="validate"></div>
    </div>

    <div class="form-group">
        <label for="an">Rek. Atas Nama</label>
        <input wire:model="an" id="an" type="text" class="form-control">
        <div class="validate"></div>
    </div>

    <div class="form-group">
        <label>Total Pembayaran</label>
        <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->class->biaya_spp, 0, ",", ".")}}" disabled>
        <div class="validate"></div>
    </div>

@elseif($cara_pembayaran === "briva")
    <div class="form-group">
        <label>Total Pembayaran</label>
        <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->class->biaya_spp, 0, ",", ".")}}" disabled>
        <div class="validate"></div>
    </div>

    {{-- <small class="text-danger">Expired: {{ now()->addDays(1) }}</small> --}}

    <div class="card p-3 shadow mt-3">
        <div class="card-body">
            <div class="mb-5">
                <h5><b>Cara transaksi untuk pembayaran dengan BRIVA di BRI Mobile</b></h5>
                <ol>
                    <li>Login ke aplikasi BRI Mobile lalu pilih menu Pembayaran.</li>
                    <li>Setelah itu, pilih menu BRIVA.</li>
                    <li>Masukkan nomor rekening Virtual Account di kolom yang sudah tersedia dan tuliskan nominal pembayaran yang harus dibayarkan (harus sesuai dengan tagihan).</li>
                    <li>Masukkan PIN dan klik Kirim.</li>
                    <li>Transaksi telah selesai. Bukti pembayaran akan segera dikirimkan melalui SMS.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Cara bayar BRIVA melalui EDC BRI dari Agen BRILink</b></h5>
                <ol>
                    <li>Pilih menu Mini ATM lalu klik menu Pembayaran.</li>
                    <li>Pilih menu BRIVA.</li>
                    <li>Gesek kartu ATM milikmu ke mesin EDC BRI.</li>
                    <li>Masukkan nomor rekening Virtual Account yang sudah tersedia.</li>
                    <li>Masukkan PIN kartu ATM milikmu.</li>
                    <li>Ketika muncul konfirmasi pembayaran, periksa ulang dan klik Lanjut jika datanya sudah benar.</li>
                    <li>Transaksi selesai dan bukti pembayaran bisa kamu ambil.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Cara bayar BRIVA melalui teller</b></h5>
                <ol>
                    <li>Datang ke kantor cabang BRI terdekat, isi slip Setoran Tunai.</li>
                    <li>Tulis 15 digit nomor virtual account yang sudah kamu dapatkan.</li>
                    <li>Tulis jumlah pembayaran sesuai nominal tagihan,</li>
                    <li>Jika transaksi sudah dilakukan, kamu akan mendapatkan fotokopi slip setoran tunai sebagai bukti pembayaran.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Cara transfer BRIVA melalui ATM bank lain</b></h5>
                <ol>
                    <li>Masukkan kartu ATM dan PIN.</li>
                    <li>Klik menu Transfer Antarbank. </li>
                    <li>Masukan Kode Bank BRI (002) dan nomor Virtual Account.</li>
                    <li>Masukan nominal pembayaran yang sesuai dengan tagihan.</li>
                    <li>Proses pembayaran dengan klik YA.</li>
                    <li>Transaksi selesai.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Cara bayar BRIVA melalui teller bank lain</b> <br> <small class="text-primary">Slip pemindahbukuan (transfer)</small></h5>
                <ol>
                    <li>Dalam slip tersebut, tuliskan nama bank tujuan: Bank BRI</li>
                    <li>Isi nomor rekening tujuan dengan nomor Virtual Account.</li>
                    <li>Masukan jumlah pembayaran sesuai nominal tagihan.</li>
                    <li>Jika transaksi telah selesai, kamu akan mendapat fotokopi slip pemindahbukuan sebagai bukti pembayaran.</li>
                </ol>
            </div>
        </div>
    </div>

@elseif($cara_pembayaran === "different_bank")
    <div class="form-group">
        <label for="nama_bank">Nama Bank</label>
        <input wire:model="nama_bank" id="nama_bank" type="text" class="form-control" placeholder="Masukan Nama Bank yang digunakan">
        <div class="validate"></div>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="no_rek">No. Rekening Bank</label>
            <input wire:model="no_rek" id="no_rek" type="number" class="form-control" placeholder="No.Rek Bank untuk Pembayaran SPP">
            <div class="validate"></div>
        </div>

        <div class="form-group">
            <label>Total Pembayaran</label>
            <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->class->biaya_spp, 0, ",", ".")}}" disabled>
            <div class="validate"></div>
        </div>
    </div>
@endif
