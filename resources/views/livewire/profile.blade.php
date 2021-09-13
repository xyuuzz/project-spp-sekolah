<div class="container mt-3 mb-5">

    <div class="section-title">
        <h2>Profil Ananda <b>{{auth()->user()->name}}</b></h2>
    </div>


    <div class="mt-3 col-lg-9 container">
        <a href="{{route("student")}}" class="btn btn-outline-info mb-3">Kembali ke Home</a>
        <div class="card">
            <div class="card-body">
{{--                photo profile--}}
                <p class="text-center">
                    <img src="{{asset("storage/photo_profile_student/$photo_profile")}}" alt="" class="img-fluid rounded" width="300">
                </p>
{{--                    nama siswa --}}
                <div class="card mt-2">
                    <h5 class="ml-3">Nama :
                        <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$name}}</span>
                    </h5>
                </div>
{{--                    kelas yang ditempati--}}
                <div class="card mt-2">
                    <h5 class="ml-3">Kelas Yang Ditempati :
                       <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$class}}</span>
                    </h5>
                </div>
{{--                    email --}}
                <div class="card mt-2">
                    <h5 class="ml-3">Email :
                        <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$email}}</span>
                    </h5>
                </div>
{{--                    gender / jenis kelamin--}}
                <div class="card mt-2">
                    <h5 class="ml-3">Jenis Kelamin :
                        <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$gender}}</span>
                    </h5>
                </div>
{{--                    nisn & nis --}}
                <div class="card mt-2">
                    <h5 class="ml-3">NISN | NIS :
                        <div class="float-lg-right mr-5">
                            <span class="border-bottom border-primary text-bold">{{$nisn}}</span>

                            <span class="ml-2 mr-2">|</span>
                            <span class="border-bottom border-primary">{{$nis}}</span>
                        </div>
                    </h5>
                </div>
{{--                    no handphone --}}
                <div class="card mt-2">
                    <h5 class="ml-3">No. Handphone :
                        <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$number_phone}}</span>
                    </h5>
                </div>
                </div>
        </div>
    </div>
</div>
