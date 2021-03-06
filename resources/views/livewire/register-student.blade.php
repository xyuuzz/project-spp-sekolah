<div>
<div class="logo">
    <h1>Pendaftaran Akun Siswa Kelas {{$link_register->class->class}}</h1>
    <!-- if logo is image enable this
        <a class="brand-logo" href="#index.html">
            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
        </a> -->
</div>
<div class="workinghny-block-grid">
    <div class="workinghny-left-img ">
        <img src="{{asset("assets/img/register_page/register.jpg")}}" class="img-responsive" alt="img" width="500" />
    </div>
    <div class="form-right-inf">

        <div class="login-form-content">
            <form wire:submit.prevent="register" class="signin-form">
                <div class="one-frm">
                    <label for="name">Nama
                        @error("name")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <input wire:model.defer="name" id="name" type="text" placeholder="Type your FullName">
                </div>
                <div class="one-frm">
                    <label for="no_absen">No Absen
                        @error("no_absen")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <input wire:model.defer="no_absen" id="no_absen" type="number" placeholder="No.Absen anda dikelas">
                </div>
                <div class="one-frm">
                    <label for="email">Email
                        @error("email")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <input wire:model.defer="email" id="email" type="email" placeholder="Type email of your account">
                </div>
                <div class="one-frm">
                    <label for="password">Password
                        @error("password")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <input wire:model.defer="password" id="password" type="password" placeholder="Type password of your account">
                </div>
                <div class="one-frm">
                    <label for="phone_number">No. Handphone Whatsapp
                        @error("phone_number")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <input wire:model.defer="phone_number" id="phone_number" type="number" placeholder="Type Your Whatsapp Number">
                </div>
                <div class="one-frm mb-3">
                    <label for="gender">Jenis Kelamin
                        @error("gender")
                        <small class="text-danger ml-3">*{{$message}}</small>
                        @enderror
                    </label>
                    <select id="gender" class="form-control" wire:model.defer="gender" id="gender">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="one-frm d-flex">
                    <div class="mr-2">
                        <label for="nisn">No. NISN
                            @error("nisn")
                            <br><small class="text-danger">*{{$message}}</small>
                            @enderror
                        </label>
                        <input wire:model.defer="nisn" id="nisn" type="number" placeholder="NISN Number">
                    </div>
                    <div>
                        <label for="nis">No. NIS
                            @error("nis")
                            <br><small class="text-danger">*{{$message}}</small>
                            @enderror
                        </label>
                        <input wire:model.defer="nis" id="nis" type="number" placeholder="NIS Number">
                    </div>
                </div>

                <button type="submit" class="btn btn-style mt-3">Daftar!</button>
            </form>
        </div>
    </div>
</div>
</div>


