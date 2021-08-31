<div class="container">

    <div class="section-title" data-aos="zoom-out">
        <h2>Pembayaran Bulanan SPP Siswa </h2>
        <p>Pembayaran SPP</p>
    </div>

    <div class="row mt-5">

        <div class="col-lg-4" data-aos="fade-right">
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

        <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">

            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
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
