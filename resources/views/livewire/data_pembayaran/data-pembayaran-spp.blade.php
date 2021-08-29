<div class="container">
    <div class="section-title">
        <h2>Data Pembayaran SPP Siswa</h2>
    </div>

    @include("livewire.partials.alert")
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
{{--        @if(method_exists($data, "perPage"))--}}
{{--            <div class="d-flex justify-content-center">--}}
{{--                {{$data->links("livewire.partials.pagination")}}--}}
{{--            </div>--}}
{{--        @endif--}}

        <table wire:loading.class="d-none" class="table table-hover table-responsive mt-4">
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
</div>
