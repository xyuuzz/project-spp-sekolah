<div class="container">
    <div class="row">
        <div class="col-lg-9 text-center text-lg-left">
            <h3>Download Data Pembayaran SPP Siswa Bulan Ini</h3>
            <p>Data ini berbentuk file Excel yang Telah Dikelompokan Setiap Kelas. Berisi data siswa, tanggal pembayaran serta status pembayaran</p>
        </div>
        <div class="col-lg-3 cta-btn-container text-center">
            <a wire:loading.class="d-none" wire:click="download()" class="cta-btn align-middle"
               style="cursor: pointer;">Download</a><br>
                <img src="http://gifimage.net/wp-content/uploads/2018/04/loading-gif-orange-8.gif" alt="" width="75" class="align-middle d-none" wire:loading.class="d-inline">
        </div>
    </div>
{{--    <p>Atau Lihat data Pembayaran SPP Siswa pada link <a href="#">Berikut</a></p>--}}
</div>
