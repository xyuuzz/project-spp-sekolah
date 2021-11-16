<div class="container">
    <div class="section-title">
        <h2>Pembayaran Bulanan SPP Siswa </h2>
        <p>Pembayaran SPP</p>
    </div>

    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="info">
                <div class="email">
                    <i class="icofont-envelope"></i>
                    <h4>Email Sekolah:</h4>
                    <p>info@example.com</p>
                </div>

                <div class="phone">
                    <i class="icofont-bank"></i>
                    <h4>No. Rekening Sekolah:</h4>
                    <p>+1 5589 55488 55s</p>
                </div>

            </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">
            @if($statusPembayaran === null)
            <div class="mb-3 d-lg-flex justify-content-between text-center">

                <div class="container">
                    @include("livewire.partials.alert")
                    {{-- <div class="form-group">
                        <label for="cara_pembayaran"><h5>Pilih Opsi Cara Pembayaran SPP</h5></label>
                        <select wire:change="resetValue" wire:model="cara_pembayaran" id="cara_pembayaran" class="form-control">
                            <option value="tf_antar_bri">Transfer Antar Rek. BRI</option>
                            <option value="briva">BRI Virtual Account | BRIVA</option>
                            <option value="tf_antar_bni">Transfer Antar Rek. BNI</option>
                            <option value="bni_va">BNI Virtual Account </option>
                            <option value="tf_antar_bca">Transfer Antar Rek. BCA</option>
                            <option value="bca_va">BCA Virtual Account</option>
                            <option value="sakuku">Sakuku BCA</option>
                            <option value="tripay">Pakai Tripay</option>
                            <option value="manual">Bayar dengan Kirim bukti transfer</option>
                        </select>
                    </div> --}}
                </div>

            </div>
            <form wire:submit.prevent="submitPembayaranSpp" class="container">
                @include("livewire.bayar_spp.form_group")

                <button wire:loading.remove.class="d-block" wire:loading.remove wire:target="setTripayPayment,submitPembayaranSpp" class="btn btn-primary text-center mt-3 d-block" type="submit">Submit</button>

                <p class="text-center mt-3">
                    <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="50" class="float-left d-none" wire:loading.remove.class="d-none" wire:target="setTripayPayment,submitPembayaranSpp">
                </p>
            </form>
            @elseif(! $statusPembayaran)
                <h2 class="text-capitalize text-center"><b>segera lunasi pembayaran anda</b></h2>
                <hr>
                <p>Link Pembayaran : <a target="_blank" href="{{ $pembayaran?->link_pembayaran }}">Klik disini</a></p>

                @if($pembayaran?->qr_code)
                    <p>Atau lihat QR Code anda di <a target="_blank" href="{{ $pembayaran?->qr_code }}">link ini</a></p>
                @endif
            @elseif($statusPembayaran)
                <h2 class="text-capitalize text-center"><b>spp bulan ini sudah lunas</b></h2>
                <hr>
                <p class="text-center">Terimakasih Telah Membayar Spp Sekolah{{ (int)date("d",strtotime($pembayaran->kadaluarsa)) < 20 ? " Tepat Waktu!" : "!"}}</p>
            @endif
        </div>

    </div>

</div>
