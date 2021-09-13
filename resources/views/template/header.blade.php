<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html">Nama Sekolah</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="{{ asset("assets") }}/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
            @if(auth()->user()->role === "admin")
                <li class="{{ request()->routeIs("admin") ? "active" : "" }}"><a href="{{ route("admin") }}">Home</a></li>
                <li><a href="{{ route("admin") }}#list_teacher_student">Daftar Guru & Siswa</a></li>
                <li><a href="{{ route("admin") }}#download_spp">Download Data SPP Bulan Ini</a></li>
                <li class="{{ request()->routeIs("admin.index-register-teacher-student") ? "active" : "" }}"><a href="{{ route("admin.index-register-teacher-student") }}#list_link_teacher_student">Link Pendaftaran Guru & Siswa</a></li>
            @elseif(auth()->user()->role === "student")
                <li class="active"><a href="#">Home</a></li>
                <li class=""><a href="{{route("student")}}#bayarspp">Bayar SPP</a></li>
                <li class=""><a href="{{route("student_profile")}}#profile">Profil</a></li>
            @endif
        <li><a href="{{route("logout")}}">Log Out</a></li>

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
