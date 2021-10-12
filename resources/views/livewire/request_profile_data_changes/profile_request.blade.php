<div class="testimonial-item" style="margin-top: 100px">
{{--    @php $this->mantab($profile_request->profile_id); @endphp--}}
    <div class="container-c d-lg-flex align-items-center justify-content-center flex-wrap">
        <div class="box">
            <div class="body">
                <div class="solution_cards_box sol_card_top_3 mt-5 ml-5">
                    <div class="solution_card">
                        <div class="hover_color_bubble"></div>
                        <div class="solu_title">
                            <div class="d-flex">
                                <img src="{{asset("storage/photo_profile_student/" . $profile_request->profile->photo_profile)}}" alt="foto profil lama" class="rounded-circle" width="60">
                                <p class="card-meta mt-3 ml-2">{{$profile_request->profile->user->name}}</p>
                            </div>
                            <h3>Data Lama: </h3>
                        </div>
                        <div class="solu_description">
                            <div class="mr-2">
                                <small class="card-meta mb-2">Nama: {{$profile_request->profile->user->name}}</small><br>
                                <small class="card-meta mb-2">Jenis Kelamin: {{$profile_request->profile->user->gender}}</small><br>
                                <small class="card-meta mb-2">Email: {{$profile_request->profile->user->email}}</small><br>
                                <small class="card-meta mb-2">Password: ****</small><br>
                                <small class="card-meta mb-2">No. Whatsapp: {{$profile_request->profile->phone->phone_number}}</small><br>
                                <small class="card-meta mb-2">Kelas: {{$profile_request->profile->class->class->class}}</small><br>
                                <small class="card-meta mb-2">No. Absen: {{$profile_request->profile->no_absen}}</small><br>
                                <small class="card-meta mb-2">No. NISN: {{$profile_request->profile->nisn}}</small><br>
                                <small class="card-meta mb-2">No. NIS: {{$profile_request->profile->nis}}</small><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content d-flex flex-column align-items-center justify-content-center">
                    <div>
                        <h3 class="solu_title">Data Baru: </h3>
                        <small class="mb-2">Foto Profil :
                            <img src="{{asset("storage/photo_profile_student/" . $profile_request->photo_profile)}}" alt="foto profil lama" class="rounded-circle" width="45">
                        </small>
                        <br>
                        <small class="mb-2">Nama:
                            <span class="font-weight-bold {{$profile_request->profile->user->name === $profile_request->name ? "text-success" : "text-light"}}">{{$profile_request->name}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">Jenis Kelamin:
                            <span class="font-weight-bold {{$profile_request->profile->user->gender === $profile_request->gender ? "text-success" : "text-light"}}">{{$profile_request->gender}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">Email:
                            <span class="font-weight-bold {{$profile_request->profile->user->email === $profile_request->email ? "text-success" : "text-light"}}">{{$profile_request->email}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">Password:
                            <span class="font-weight-bold {{$profile_request->profile->user->password === $profile_request->password ? "text-success" : "text-light"}}">****
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">No. Whatsapp:
                            <span class="font-weight-bold {{$profile_request->profile->phone->phone_number === $profile_request->phone_number ? "text-success" : "text-light"}}">{{$profile_request->phone_number}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">Kelas:
                            <span class="font-weight-bold {{$profile_request->profile->class->class_id === $profile_request->class_id ? "text-success" : "text-light"}}">{{$profile_request->class->class}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">No. Absen:
                            <span class="font-weight-bold {{$profile_request->profile->no_absen === $profile_request->no_absen ? "text-success" : "text-light"}}">{{$profile_request->no_absen}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">No. NISN:
                            <span class="font-weight-bold {{$profile_request->profile->nisn === $profile_request->nisn ? "text-success" : "text-light"}}">{{$profile_request->nisn}}
                            </span>
                        </small>
                        <br>
                        <small class="mb-2">No. NIS:
                            <span class="font-weight-bold {{$profile_request->profile->nis === $profile_request->nis ? "text-success" : "text-light"}}">{{$profile_request->nis}}
                            </span>
                        </small>
                        <br>
                        <button wire:click="request_decline({{$profile_request->id}})" type="button" class="btn-custom decline mt-2">Ditolak</button>
                        <button wire:click="request_accept({{$profile_request->id}})" type="button" class="btn-custom accept mt-2">Diterima</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <div class="solution_cards_box sol_card_top_3 mt-5 ml-5">--}}
{{--        <div class="solution_card">--}}
{{--            <div class="hover_color_bubble"></div>--}}
{{--            <div class="d-lg-flex">--}}
{{--                <div>--}}
{{--                    <div class="solu_title">--}}
{{--                        <h3>Data Lama: </h3>--}}
{{--                    </div>--}}
{{--                    <div class="solu_description">--}}
{{--                        <div class="mr-2">--}}
{{--                            <small class="card-meta mb-2">Nama: {{$profile_request->profile->user->name}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Jenis Kelamin: {{$profile_request->profile->user->gender}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Email: {{$profile_request->profile->user->email}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Password: ****</small><br>--}}
{{--                            <small class="card-meta mb-2">No. Whatsapp: {{$profile_request->profile->phone->phone_number}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Kelas: {{$profile_request->profile->class->class->class}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. Absen: {{$profile_request->profile->no_absen}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. NISN: {{$profile_request->profile->nisn}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. NIS: {{$profile_request->profile->nis}}</small><br>--}}
{{--                        </div>--}}
{{--                        <button type="button" class="decline mt-2">Ditolak</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <svg id="chart" width="80" height="225">--}}
{{--                    <line x1="20" y1="80" x2="20" y2="350"></line>--}}
{{--                </svg>--}}
{{--                <div class="">--}}
{{--                    <div class="solu_title">--}}
{{--                        <h3>Data Baru: </h3>--}}
{{--                    </div>--}}
{{--                    <div class="solu_description">--}}
{{--                        <div class="">--}}
{{--                            <small class="card-meta mb-2">Nama: {{$profile_request->profile->user->name}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Jenis Kelamin: {{$profile_request->profile->user->gender}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Email: {{$profile_request->profile->user->email}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Password: ****</small><br>--}}
{{--                            <small class="card-meta mb-2">No. Whatsapp: {{$profile_request->profile->phone->phone_number}}</small><br>--}}
{{--                            <small class="card-meta mb-2">Kelas: {{$profile_request->profile->class->class->class}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. Absen: {{$profile_request->profile->no_absen}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. NISN: {{$profile_request->profile->nisn}}</small><br>--}}
{{--                            <small class="card-meta mb-2">No. NIS: {{$profile_request->profile->nis}}</small><br>--}}
{{--                        </div>--}}
{{--                        <button type="button" class="accept mt-2">Diterima</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
