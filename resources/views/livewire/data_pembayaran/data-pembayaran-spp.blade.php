<div class="container">
    @if($view !== "detail")
        <div class="section-title">
            <h2>Data Pembayaran SPP Siswa</h2>
        </div>
    @endif

    @if($view === "hidden")
        <button wire:click="$set('view', 'index')" class="btn btn-primary">Klik Untuk Lihat Data Pembayaran SPP Siswa!</button>
    @endif

    @include("livewire.partials.alert")

@if($view === "index")
    <div class="tab-pane active show">
        <div class="d-lg-flex justify-content-between">
            <input wire:model="search" type="text" class="form-control col-lg-6 mb-3" placeholder="Cari Berdasarkan Nama Siswa, Kelas, atau No. Rekening!">

            <select wire:model="month" class="form-control col-lg-3 mb-3">
                <option value="all">Semua Bulan</option>
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

            <select wire:model="year" class="form-control col-lg-2">
                <option value="all">Semua Tahun</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
            </select>
        </div>

        <div class="d-flex justify-content-center">
            {{$payments->links("livewire.partials.pagination")}}
        </div>

        <p class="text-center mt-3">
            <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none" wire:loading.remove.class="d-none" wire:target="!show">
        </p>

        <table wire:loading.remove wire:target="!show" class="table table-hover table-responsive mt-4">
            <thead>
                <tr class="text-center">
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Tanggal Pembayaran</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">No.Rekening</th>
                    <th>Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

            @each("livewire.data_pembayaran.table", $payments, "payment", "livewire.partials.data_table_not_found")

            </tbody>
        </table>
    </div>
@elseif($view === "detail")
    <livewire:detail-payment/>
@endif
</div>

