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
            <div class="mb-3 d-lg-flex justify-content-between text-center">
                <button wire:click="$set('cara_pembayaran', 'struk_tf')" class="btn mb-2 {{$cara_pembayaran == "struk_tf" ? "btn-info" : "btn-outline-info"}}">Dengan Struk</button>
                <button wire:click="$set('cara_pembayaran', 'same_bank')" class="btn mb-2 {{$cara_pembayaran == "same_bank" ? "btn-primary" : "btn-outline-primary"}}">Transfer dengan Bank BCA</button>
                <button wire:click="$set('cara_pembayaran', 'different_bank')" class="btn mb-2 {{$cara_pembayaran == "different_bank" ? "btn-secondary" : "btn-outline-secondary"}}">Transfer dengan Bank Yang lain</button>
            </div>
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                @include("livewire.bayar_spp.form_group")

                <div class="mb-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Pembayaran Anda Akan Diproses Oleh Guru Wali Kelas!</div>
                </div>
                <div class="text-center"><button type="submit">Submit</button></div>
            </form>

        </div>

    </div>

</div>
