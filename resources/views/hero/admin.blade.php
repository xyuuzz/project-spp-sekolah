<section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Posisi Anda Sekarang sebagai Admin</h2>
                <p class="animate__animated fanimate__adeInUp">Laman Website Pembayaran SPP Sekolah SMP Jamial Anwar</p>
                <a href="{{route("admin")}}#list_teacher_student" class="btn-get-started animate__animated animate__fadeInUp scrollto">Cek Guru dan Siswa yang terdaftar</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Sebagai Admin Anda dapat Melakukan Hal sebagai Berikut</h2>
                <p class="animate__animated animate__fadeInUp">
                    <span class="border-bottom pb-2 mb-2 d-inline-block">Dapat memantau seluruh aktifitas yang terjadi di sini</span>
                    <span class="border-bottom pb-2 mb-2 d-inline-block">Meninjau Guru dan Siswa yang terdaftar</span>
                    <span class="border-bottom pb-2 mb-2 d-inline-block">Membuat link pendaftaran Guru dan Siswa yang dibedakan Berdasarkan Kelas</span>
                    <span class="border-bottom pb-2 mb-2 d-inline-block"> Dapat Mendownload File Excel berupa Data Pembayaran SPP Siswa Setiap Bulan.</span>
                </p>
                {{-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> --}}
            </div>
        </div>

        <div class="carousel-item">
            <div class="carousel-container">
                <h2 class="animate__animated animate__fadeInDown">Tinjau Link Pendaftaran <br> Guru Wali Kelas & Siswa</h2>
                <p class="animate__animated animate__fadeInUp">
                    Klik link <a href="{{route("admin.index-register-teacher-student")}}#list_link_teacher_student">Berikut</a> untuk Menuju ke Tabel Data Link Pendaftaran Guru Wali Kelas & Siswa
                </p>
                {{-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> --}}
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
