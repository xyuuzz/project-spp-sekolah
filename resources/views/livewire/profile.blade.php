<div class="container mt-5 mb-5">
    @if($view === "edit")
        <form wire:submit.prevent="submit" id="editProfile"></form>
    @endif

    <div class="section-title">
        <h2>Profil Ananda <b>{{auth()->user()->name}}</b></h2>
    </div>

    <div class="mt-3 col-lg-9 container">
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex justify-content-between mb-2">
                    <a href="{{route("student")}}" class="btn btn-secondary">Kembali</a>
                </div>
                <p class="text-center">
                    <img src="{{asset("storage/photo_profile_student/$photo_profile")}}" alt="" class="img-fluid rounded" width="300">
                    @if($view === 'edit')
                        <div class="form-group col-8 container">
                            <input wire:model="photo_profile" type="file" class="form-control">
                        </div>
                    @endif
                </p>
                <div @class([
                    'card' => $view === 'index',
                    'mt-4',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                 ])>
                    <h5 class="ml-3">Nama :
                        @if($view === "index")
                            <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$name}}</span>
                        @endif
                    </h5>
                    @if($view === "edit")
                        <input wire:model="name" type="string" class="form-control col-7">
                    @endif
                </div>
                <div @class([
                    'card' => $view === 'index',
                    'mt-2',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                ])>
                    <h5 class="ml-3">Kelas Yang Ditempati :
                        @if($view === "index")
                           <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$class}}</span>
                        @endif
                    </h5>
                    @if($view === "edit")
                        <input wire:model="class" type="string" class="form-control col-7" placeholder="Contoh Format Tulisan : Kelas 8B = XIIIB">
                    @endif
                </div>
                <div @class([
                    'card' => $view === 'index',
                    'mt-2',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                ])>
                    <h5 class="ml-3">Email :
                        @if($view === "index")
                        <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$email}}</span>
                        @endif
                    </h5>
                    @if($view === "edit")
                        <input wire:model="email" type="email" class="form-control col-7" placeholder="Masukan Email dengan Format Yang benar!">
                    @endif
                </div>
                <div @class([
                    'card' => $view === 'index',
                    'mt-2',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                ])>
                    <h5 class="ml-3">Jenis Kelamin :
                        @if($view === "index")
                            <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$gender}}</span>
                        @endif
                    </h5>
                    @if($view === "edit")
                        <select wire:model="gender" form="editProfile" class="form-control col-7">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    @endif
                </div>
                <div @class([
                    'card' => $view === 'index',
                    'mt-2',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                ])>
                    <h5 class="ml-3">NISN | NIS :
                        <div class="float-lg-right mr-5">
                            @if($view === "index")
                                <span class="border-bottom border-primary text-bold">{{$nisn}}</span>

                                <span class="ml-2 mr-2">|</span>
                                <span class="border-bottom border-primary">{{$nis}}</span>
                            @endif
                        </div>
                    </h5>
                    @if($view === "edit")
                        <div class="d-lg-flex justify-content-between col-7 form-group">
                            <input wire:model="nisn" type="number" class="form-control" placeholder="Masukan NISN Sekolah!">
                            <span class="ml-2 mr-2">|</span>
                            <div class="">
                                <input wire:model="nis" type="number" class="form-control">
                            </div>
                        </div>
                    @endif
                </div>
                <div @class([
                    'card' => $view === 'index',
                    'mt-2',
                    'd-lg-flex' => $view === 'edit',
                    'justify-content-between' => $view === 'edit',
                ])>
                    <h5 class="ml-3">No. Handphone :
                        @if($view === "index")
                            <span class="border-bottom border-primary float-lg-right mr-5 text-bold">{{$number_phone}}</span>
                        @endif
                    </h5>
                    @if($view === "edit")
                        <input wire:model="number_phone" type="numeric" class="form-control col-7" >
                    @endif
                </div>
                <button wire:click="$set('view', 'edit')" class="btn btn-info float-right mt-3">Edit Profile</button>
            </div>
        </div>
    </div>

</div>
