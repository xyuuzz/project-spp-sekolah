<div class="container mt-3 mb-5">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">Form Untuk Mengajukan Perubahan Data Profile</h4>
        </div>

        <div class="card-body">
            @if($view === "text")
                <p class="text-center">
                    @if(session("success"))
                        <small class="text-success">{{session("success")}}</small>
                    @elseif(session("failed"))
                        <small class="text-danger">{{session("failed")}}</small>
                    @endif
                </p>
                <p class="text-center text-secondary">
                    @if($confirm)
                        Perubahan yang Anda Ajukan Terakhir Kali Sudah disetujui oleh Guru Wali Kelas Anda!
                    @elseif($confirm === null)
                        Klik Tombol dibawah jika anda ingin mengajukan Perubahan Data kepada Wali Kelas!
                    @else
                        Anda sudah mengajukan Perubahan Data Ke Guru Wali Kelas, ingin merubah data nya lagi?
                    @endif

                </p>
                <p class="text-center">
                    <button wire:click="changeView" class="btn btn-primary">Ubah</button>
                </p>
            @else
                <form wire:submit.prevent="submitForm" id="editProfile">
                    <div class="d-lg-flex row justify-content container-fluid">
                        <div class="col-lg-6">
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="name">Nama: </label>
                                    <input id="name" wire:model="name" type="string" class="form-control col-lg-10 ml-3">
                                </div>
                                @error("name")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="email">Akun Email: </label>
                                    <input id="email" wire:model="email" type="string" class="form-control col-lg-9 ml-3">
                                </div>
                                @error("email")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="gender">Jenis Kelamin: </label>
                                    <select wire:model="gender" form="editProfile" class="form-control col-lg-7 ml-3">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                @error("gender")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="nisn">NISN: </label>
                                    <input id="nisn" wire:model="nisn" type="numeric" class="form-control col-lg-10 ml-3">
                                </div>
                                @error("nisn")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row justify-content-between">
                                    <div>
                                        <label for="photo_profile">Foto Profil: </label>
                                        <input id="photo_profile" wire:model="photo_profile" type="file" class="form-control ">
                                    </div>
                                    <br>
                                    <div @class([
                                        "d-none" => $photo_profile?->temporaryUrl() === null,
                                        "rounded-circle",
                                        "mt-3"
                                        ])>
                                        <span class="font-italic font-weight-bolder">Preview : </span>
                                        <br>
                                        <img src="{{$photo_profile?->temporaryUrl()}}" alt="" width="125" height="125">
                                    </div>
                                </div>
                                <img src="https://gifimage.net/wp-content/uploads/2017/09/animated-loading-gif-2.gif" alt="loading gif" width="80" class="mt-3" wire:loading.inline wire:target="photo_profile">
                                @error("photo_profile")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="password">Password Akun: </label>
                                    <input id="password" wire:model="password" type="password" class="form-control col-lg-8 ml-3" placeholder="Fill if you'll Change Password">
                                </div>
                                @error("password")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="class">Kelas: </label>
                                    <select wire:model="class_id" form="editProfile" class="form-control col-lg-10 ml-3">
                                        @foreach(\App\Models\SchoolClass::get() as $class)
                                            <option value="{{$class->id}}">{{$class->class}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error("class_id")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="phone_number">No. Handphone: </label>
                                    <input id="phone_number" wire:model="phone_number" type="numeric" class="form-control col-lg-8 ml-3">
                                </div>
                                @error("phone_number")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="nis">NIS: </label>
                                    <input id="nis" wire:model="nis" type="numeric" class="form-control col-lg-10 ml-3">
                                </div>
                                @error("nis")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                            <div class="form-group ml-lg-5">
                                <div class="d-lg-flex row">
                                    <label for="no_absen">No. Absen: </label>
                                    <input id="no_absen" wire:model="no_absen" type="numeric" class="form-control col-lg-10 ml-3">
                                </div>
                                @error("no_absen")<small class="text-danger ml-lg-n3">{{$message}}</small>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-lg-flex justify-content-between">
                        <button type="button" wire:click="changeView" class="btn btn-primary">Kembali</button>
                        <button type="submit" class="float-right btn btn-outline-success">Submit</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

{{--    script untuk menghilangkan alert setelah 5 detik muncul--}}
    <script>
        window.addEventListener('submit', event => {
            setTimeout( function() {
                $(".text-center small").remove();
            }, 5000);
        });
    </script>
</div>
