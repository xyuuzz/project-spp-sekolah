@if($cara_pembayaran === "same_bank")
    <div class="form-group">

    <div class="form-group">
        <label for="no_rek">No. Rekening Bank</label>
        <input wire:model="no_rek" id="no_rek" type="number" class="form-control" placeholder="No.Rek Bank untuk Pembayaran SPP">
        <div class="validate"></div>
    </div>

    <div class="form-group">
        <label>Total Pembayaran</label>
        <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->biaya_spp, 0, ",", ".")}}" disabled>
        <div class="validate"></div>
    </div>
</div>
@elseif($cara_pembayaran === "struk_tf")
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
            <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->biaya_spp, 0, ",", ".")}}" disabled>
            <div class="validate"></div>
        </div>

        <div class="form-group">
            <label for="struk_transfer">Foto Struk Transfer </label>
            <input wire:model="struk_transfer" id="struk_transfer" type="file" class="form-control">
            <div class="validate"></div>
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
            <input type="text" class="form-control" value="Rp. {{number_format(auth()->user()->profile->class->biaya_spp, 0, ",", ".")}}" disabled>
            <div class="validate"></div>
        </div>
    </div>
@endif
