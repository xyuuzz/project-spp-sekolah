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
                <button wire:click="$set('cara_pembayaran', 'struk_tf')" class="btn mb-2 {{$cara_pembayaran == "struk_tf" ? "btn-info" : "btn-outline-info"}}">Dengan Struk</button>
                <button wire:click="$set('cara_pembayaran', 'same_bank')" class="btn mb-2 {{$cara_pembayaran == "same_bank" ? "btn-primary" : "btn-outline-primary"}}">Transfer dengan Bank BCA</button>
                <button wire:click="$set('cara_pembayaran', 'different_bank')" class="btn mb-2 {{$cara_pembayaran == "different_bank" ? "btn-secondary" : "btn-outline-secondary"}}">Transfer dengan Bank Yang lain</button>
            </div>
            <form wire:submit.prevent="submitPembayaranSpp">
                @include("livewire.bayar_spp.form_group")
                <button class="btn btn-tertiary text-center" type="submit">Submit</button>
            </form>
            @elseif($statusPembayaran === 0)
                <h2 class="text-capitalize text-center"><b>pembayaran anda sedang diproses</b></h2>
                <hr>
            @endif
        </div>

    </div>

</div>
