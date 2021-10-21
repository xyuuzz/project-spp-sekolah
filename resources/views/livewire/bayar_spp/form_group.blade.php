@if($cara_pembayaran === "briva" ||
    $cara_pembayaran === "bca_va" ||
    $cara_pembayaran === "bni_va"
)
    <div class="form-group">
        <label>Total Pembayaran</label>
        <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->class->biaya_spp, 0, ",", ".")}}" disabled>
        <div class="validate"></div>
    </div>
@endif


@if($cara_pembayaran === "tf_antar_bri" ||
    $cara_pembayaran === "tf_antar_bni" ||
    $cara_pembayaran === "tf_antar_bca"
)
    <div class="form-group">
        <label for="no_rek">No. Rekening Bank</label>
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

@elseif($cara_pembayaran === "bni_va")
    <div class="card p-3 shadow mt-3">
        <div class="card-body">
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan ATM BNI</b></h5>
                <ol>
                    <li>Masukkan Kartu Anda.</li>
                    <li>Pilih Bahasa.</li>
                    <li>Masukkan PIN ATM Anda.</li>
                    <li>Kemudian, pilih <b>Menu Lainnya.</b></li>
                    <li>Pilih <b>Transfer</b> dan pilih Jenis rekening yang akan Anda gunakan (Contoh: "Dari Rekening Tabungan").</li>
                    <li>Pilih <b>Virtual Account Billing.</b> Masukkan nomor Virtual Account Anda (Contoh: 8277087781881441).</li>
                    <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                    <li>Konfirmasi, apabila telah sesuai, lanjutkan transaksi.</li>
                    <li>Transaksi Anda telah selesai.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan Mobile Banking BNI</b></h5>
                <ol>
                    <li>Akses BNI Mobile Banking melalui handphone.</li>
                    <li>Masukkan User ID dan password.</li>
                    <li>Pilih menu <b>Transfer.</b></li>
                    <li>Pilih menu <b>Virtual Account Billing</b>, lalu pilih rekening debet.</li>
                    <li>Masukkan nomor Virtual Account Anda (Contoh: 8277087781881441) pada menu <b>Input Baru.</b></li>
                    <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                    <li>Konfirmasi transaksi dan masukkan Password Transaksi.</li>
                    <li>Pembayaran Anda Telah Berhasil.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan iBank Personal</b></h5>
                <ol>
                    <li>Akses <a class="text-success" href="https://ibank.bni.co.id">ibank.bni.co.id</a> kemudian klik <b>Enter.</b></li>
                    <li>Masukkan <i>User ID</i> dan <i>password</i>.</li>
                    <li>Klik menu <b>Transfer</b>, lalu pilih <b>Virtual Account Billing.</b></li>
                    <li>Kemudian, masukan nomor Virtual Account Anda (Contoh: 8277087781881441) yang akan dibayarkan.</li>
                    <li>Lalu pilih rekening debet yang akan digunakan. Kemudian tekan Lanjut.</li>
                    <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                    <li>Masukkan Kode Otentikasi Token.</li>
                    <li>Anda akan menerima notifikasi bahwa transaksi berhasil.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan SMS Banking</b></h5>
                <ol>
                    <li>Buka aplikasi SMS Banking BNI.</li>
                    <li>Pilih menu <b>Transfer.</b></li>
                    <li>Pilih menu <b>Transfer rekening BNI.</b></li>
                    <li>Masukkan nomor rekening tujuan dengan 16 digit Nomor Virtual Account (Contoh: 8277087781881441).</li>
                    <li>Masukkan nominal transfer sesuai tagihan. Nominal yang berbeda tidak dapat diproses.</li>
                    <li>Pilih <b>Proses</b>, kemudian <b>Setuju.</b></li>
                    <li>Balas sms dengan mengetik pin sesuai dengan instruksi BNI. Anda akan menerima notif bahwa transaksi berhasil.</li>
                    <li>Atau dapat juga langsung mengetik sms dengan format: TRF[SPASI]NomorVA[SPASI]NOMINAL dan kemudian kirim ke 3346. Contoh: TRF 8277087781881441 44000</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dari Cabang atau Outlet BNI (Teller)</b></h5>
                <ol>
                    <li>Kunjungi Kantor Cabang/Outlet BNI terdekat.</li>
                    <li>Informasikan kepada Teller, bahwa Anda ingin melakukan pembayaran <b>Virtual Account Billing.</b></li>
                    <li>Serahkan nomor Virtual Account Anda kepada Teller.</li>
                    <li>Teller akan melakukan konfirmasi kepada Anda dan akan memproses Transaksi.</li>
                    <li>Apabila transaksi Sukses, Anda akan menerima bukti pembayaran dari Teller tersebut.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dari Agen46</b></h5>
                <ol>
                    <li>Kunjungi Agen46 terdekat (warung/took/kios dengan tulisan Agen46).</li>
                    <li>Informasikan kepada Agen46, bahwa ingin melakukan pembayaran <b>Virtual.</b></li>
                    <li>Serahkan nomor Virtual Account Anda kepada Agen46.</li>
                    <li>Agen46 akan melakukan konfirmasi kepada Anda.</li>
                    <li>Selanjutnya, transaksi akan diproses.</li>
                    <li>Apabila transaksi dinyatakan sukses, Anda akan menerima bukti pembayaran dari Agen46.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan ATM Bersama</b></h5>
                <ol>
                    <li>Masukkan kartu ke mesin ATM Bersama.</li>
                    <li>Pilih <b>Transaksi Lainnya.</b></li>
                    <li>Pilih menu <b>Transfer.</b></li>
                    <li>Pilih <b>Transfer ke Bank Lain.</b></li>
                    <li>Masukkan kode bank BNI (009) dan 16 Digit Nomor Virtual Account (Contoh: 8277087781881441).</li>
                    <li>Masukkan nominal transfer sesuai tagihan Anda. Nominal yang berbeda tidak dapat diproses.
                    </li>
                    <li>Konfirmasi rincian Anda akan tampil pada layar.</li>
                    <li>Jika sudah sesuai, klik 'Ya' untuk melanjutkan.</li>
                    <li>Transaksi Anda telah berhasil.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dengan ATM Bank lain</b></h5>
                <ol>
                    <li>Pilih menu <b>Transfer antar bank</b> atau <b>Transfer online antar bank.</b></li>
                    <li>Masukkan kode bank BNI (009) atau pilih bank yang dituju yaitu BNI.</li>
                    <li>Masukan 16 Digit Nomor Virtual Account pada kolom rekening tujuan (Contoh: 8277087781881441).</li>
                    <li>Masukkan nominal transfer sesuai tagihan Anda. Nominal yang berbeda tidak dapat diproses.</li>
                    <li>Masukkan jumlah pembayaran. (Contoh: 44000).
                    </li>
                    <li>Konfirmasi rincian Anda akan tampil pada layar.</li>
                    <li>Jika sudah sesuai, klik Ya untuk melanjutkan.</li>
                    <li>Transaksi Anda telah berhasil.</li>
                </ol>
            </div>
            <div class="mb-5">
                <h5><b>Pembayaran BNI Virtual Account dari OVO</b></h5>
                <ol>
                    <li>Buka aplikasi OVO.</li>
                    <li>Pilih menu <b>Transfer.</b></li>
                    <li>Pilih Rekening <b>Bank.</b></li>
                    <li>Masukkan kode bank BNI (009) atau pilih bank yang dituju yaitu BNI.</li>
                    <li>Masukan 16 Digit Nomor Virtual Account pada kolom rekening tujuan (Contoh: 8277087781881441).</li>
                    <li>Masukkan nominal transfer sesuai tagihan Anda. <b>Pilih Transfer.</b></li>
                    <li>Konfirmasi rincian Anda akan tampil di layar.</li>
                    <li>Jika sudah sesuai, klik <b>Konfirmasi</b> untuk melanjutkan.
                    </li>
                    <li>Transaksi Anda telah berhasil.</li>
                </ol>
            </div>
        </div>
    </div>

@elseif($cara_pembayaran === "bca_va")
    <div class="container">
        <a target="_blank" href="https://seu.apps.undip.ac.id/fileupload/Petunjuk-Pembayaran-VA.pdf" class="text-primary">PDF Cara Pembayaran BNI Vertual Account</a>
    </div>
@elseif($cara_pembayaran === "manual")

    <div class="form-group">
        <div class="form-group">
            <label for="no_rek">No. Rekening Bank</label>
            <input wire:model="no_rek" id="no_rek" type="number" class="form-control">
            <div class="validate"></div>
        </div>

        <div class="form-group">
            <label for="an">Atas nama</label>
            <input wire:model="an" id="an" type="text" class="form-control">
            <div class="validate"></div>
        </div>

        <div class="form-group">
            <label for="bukti">Foto Bukti Pembayaran: </label>
            <input wire:model="bukti_pembayaran" type="file" class="form-control">
        </div>
    </div>
@endif
