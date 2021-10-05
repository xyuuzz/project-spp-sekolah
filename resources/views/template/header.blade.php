<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">Nama Sekolah</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="{{ asset("assets") }}/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
{{--            @if(auth()->user()->role === "admin")--}}
            @can("is_admin")
                <li class="{{ request()->routeIs("admin") ? "active" : "" }}"><a href="{{ route("admin") }}">Home</a></li>
                <li><a href="{{ route("admin") }}#list_teacher_student">Daftar Guru & Siswa</a></li>
                <li><a href="{{ route("admin") }}#download_spp">Download Data SPP Bulan Ini</a></li>
                <li class="{{ request()->routeIs("admin.index-register-teacher-student") ? "active" : "" }}">
                    <a href="{{ route("admin.index-register-teacher-student") }}#list_link_teacher_student">Link Pendaftaran Guru & Siswa</a>
                </li>
{{--            @elseif(auth()->user()->role === "student")--}}
            @endcan
            @can("is_student")
                <li class="{{request()->route}}"><a href="{{route("student")}}">Home</a></li>
                @if($status_pembayaran === null)
                    <li class=""><a href="{{route("student")}}#bayarspp">Bayar SPP</a></li>
                @else
                    <li class=""><a href="{{route("student")}}#history-pembayaran">Lihat Riwayat Pembayaran</a></li>
                @endif
                <li class="d-flex" onmouseover="profil_header_hover()" onmouseleave="profil_header_normal()">
{{--                    <a href="{{route("student_profile")}}#profile">Profil</a>--}}
                    <a href="{{route("student_profile")}}#profile">
                        <div id="image_div">
                            <img src="{{asset("storage/photo_profile_student/" . auth()->user()->profile->photo_profile)}}" alt="foto profil" width="40" height="40" class="rounded-circle">
                            <span class="d-none text-light">Profile</span>
                        </div>
                    </a>
                </li>
{{--            @elseif(auth()->user()->role === "teacher")--}}
            @endcan
            @can("is_teacher")
                <li><a href="{{ route("teacher") }}">Home</a></li>
                <li><a href="#">Daftar Murid Kelas</a></li>
                <li><a href="#">Data Laporan Pembayaran Spp Siswa</a></li>
                <li><a href="#">Buat Laporan Ke Admin</a></li>
{{--            @endif--}}
            @endcan
        <li><a href="{{route("logout")}}">Logout Akun</a></li>

                {{-- <li class="drop-down"><a href="">Drop Down</a>
                  <ul>
                    <li><a href="#">Drop Down 1</a></li>
                    <li class="drop-down"><a href="#">Drop Down 2</a>
                      <ul>
                        <li><a href="#">Deep Drop Down 1</a></li>
                        <li><a href="#">Deep Drop Down 2</a></li>
                        <li><a href="#">Deep Drop Down 3</a></li>
                        <li><a href="#">Deep Drop Down 4</a></li>
                        <li><a href="#">Deep Drop Down 5</a></li>
                      </ul>
                    </li>
                    <li><a href="#">Drop Down 3</a></li>
                    <li><a href="#">Drop Down 4</a></li>
                    <li><a href="#">Drop Down 5</a></li>
                  </ul>
                </li> --}}
        </ul>
      </nav>

    </div>
  </header>
