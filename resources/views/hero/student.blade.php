<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Halo {{auth()->user()->gender === "Perempuan" ? "Mbak" : "Mas"}} {{auth()->user()->name}}<br>Bagaimana Kabarmu Hari ini?</h2>
                <p class="animate__animated fanimate__adeInUp text-bold">
                    @if($status_pembayaran === 1)
                        Spp Bulan Ini Sudah Lunas
                    @elseif($status_pembayaran === 0)
                        Pembayaran Anda Sedang Diproses oleh Guru Wali Kelas
                    @else
                        Anda Belum Membayar SPP bulan ini!
                    @endif
                </p>
                @if($status_pembayaran === null)
                    <a href="{{route("student")}}#bayarspp" class="btn-get-started animate__animated animate__fadeInUp scrollto"> Bayar Sekarang</a>
                @endif
{{--                @include("livewire.partials.status_pembayaran", $data=[null => "Bayar Sekarang", "tag" => '<a href="{{route("student")}}#bayarspp" class="btn-get-started animate__animated animate__fadeInUp scrollto">', "close_tag" => "</a>"])--}}
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Lihat Histori Pembayaran</h2>
                <p class="animate__animated fanimate__adeInUp">Lihat histori pembayaran ananda <b>{{ucfirst(auth()->user()->name)}}</b></p>
                <a href="{{route("student")}}#history-pembayaran" class="btn-get-started animate__animated animate__fadeInUp scrollto">Klik tombol</a>
            </div>
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
    </svg>

</section>
