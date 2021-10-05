<div>
    <div class="logo">
        <h1>Registrasi Akun Guru Kelas {{$link_register->class->class}}</h1>
    </div>
    <div class="workinghny-block-grid">
        <div class="workinghny-left-img p-relative">
            <img src="{{asset("assets/img/register_page/pict_register_teacher.jpg")}}" class="img-responsive p-absolute" alt="img" width="500" style="bottom: 10px; "/>
        </div>
        <div class="form-right-inf">

            <div class="login-form-content">
                <form wire:submit.prevent="register" class="signin-form">
                    <div class="one-frm">
                        <label for="name">Nama Anda
                            @error("name")
                            <small class="text-danger ml-3">*{{$message}}</small>
                            @enderror
                        </label>
                        <input required wire:model.defer="name" id="name" type="text" placeholder="Type your FullName">
                    </div>
                    <div class="one-frm">
                        <label for="phone_number">No. Whatsapp / Handphone
                            @error("phone_number")
                            <small class="text-danger ml-3">*{{$message}}</small>
                            @enderror
                        </label>
                        <input required wire:model.defer="phone_number" id="phone_number" type="number" placeholder="No. Telepon yang dapat dihubungi (diutamakan No. Whatsapp)">
                    </div>
                    <div class="one-frm">
                        <label for="email">Email
                            @error("email")
                            <small class="text-danger ml-3">*{{$message}}</small>
                            @enderror
                        </label>
                        <input required wire:model.defer="email" id="email" type="email" placeholder="Type email of your account">
                    </div>
                    <div class="one-frm">
                        <label for="password">Password
                            @error("password")
                            <small class="text-danger ml-3">*{{$message}}</small>
                            @enderror
                        </label>
                        <input required wire:model.defer="password" id="password" type="password" placeholder="Type password of your account">
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

                    <button type="submit" class="btn btn-style mt-3">Daftar!</button>
                </form>
            </div>
        </div>
    </div>
</div>


