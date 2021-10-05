<div class="container">

    <div class="section-title" data-aos="zoom-out">
        <h2>Kartu dibawah ini adalah Histori Pembayaran SPP Ananda {{auth()->user()->name}}</h2>
        <p>Riwayat Pembayaran</p>
    </div>

    <div class="owl-carousel testimonials-carousel" >
        @forelse(auth()->user()->profile->student_payment as $student)
            <div class="testimonial-item">
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        <p>Tanggal Pembayaran: {{$student->created_at->format("D, d-M-Y")}}</p>
                        <p>Status Pembayaran: {{$student->status ? "Sukses" : "Belum Dikonfirmasi"}}</p>
                        <p>No. Rekening Pengirim: {{$student->no_rek}}</p>
                        @if($student->status)
                            <p>Download Bukti Pembayaran(PDF) :
                                <br><a target="_blank" href="{{route("getpdf")}}">disini</a>
                            </p>
                        @endif
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>
        @empty
            <div class="testimonial-item">
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    <p>Anda Belum Pernah Membayar SPP! Mohon Segera di Lunasi!</p>
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>
        @endforelse
    </div>

</div>
