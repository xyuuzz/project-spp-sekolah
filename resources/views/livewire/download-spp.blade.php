<div class="container">
    @include("livewire.partials.alert")
    <div class="row">
        <div class="col-lg-9 text-center text-lg-left">
            <h3>Download Data Pembayaran SPP Siswa </h3>
            <p>Data ini berbentuk file Excel yang Telah Dikelompokan Setiap Kelas. Berisi data siswa, tanggal pembayaran serta status pembayaran</p>

            <div class="d-lg-flex row-lg">
                <div class="d-flex mt-2 col-lg-6 justify-content-between">
                    <small class="text-light pr-3">Bulan :</small>
                    <select class="form-control col-9" wire:model="month">
                        <option value="0">-- Pilih Bulan --</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
{{--                batas--}}
                <div class="d-flex mt-2 col-lg-6 justify-content-between">
                    <small class="text-light pr-3">Tahun :</small>
                    <select class="form-control col-9" wire:model="year">
                        <option value="0">-- Pilih Tahun --</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
            </div>

            <p class="text-light float-right mt-2">Total Data: {{$total}}</p>
        </div>

        <div class="col-lg-3 mt-md-0 text-center">
            @if($total)
                <div class="cta-btn-container mt-4">
                    <a wire:loading.class="d-none" wire:click="download()" class="cta-btn align-middle"
                    style="cursor: pointer;">Download</a>
                </div>
            @endif

            @if(session("success_ex"))
                <p class="pl-5">{{session("success_ex")}}</p>
            @endif

            <img src="http://gifimage.net/wp-content/uploads/2018/04/loading-gif-orange-8.gif" alt="" width="75" class="align-middle d-none" wire:loading.class="d-inline" wire:target="download">
        </div>
    </div>
{{--    <p>Atau Lihat data Pembayaran SPP Siswa pada link <a href="#">Berikut</a></p>--}}
</div>
