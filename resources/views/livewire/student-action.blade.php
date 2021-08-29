<div>
    <div class="mb-3">
        @include("livewire.partials.alert")
    </div>

    <div class="card">
        <div class="card-body">
            <div class="float-lg-right d-block">
                <button wire:click="backToDefaultView()" class="btn btn-outline-primary">Kembali</button>
            </div>
            <br>

            <div @class(["d-none" => $status === "edit"])>
                <div class="d-lg-flex justify-content">
                   <img src="http://4.bp.blogspot.com/_N_mOB63qPaE/TUPPcgtg46I/AAAAAAAASK8/E2M0crA1XJs/s1600/mountain%252Bwallpaper-13.jpg" class="rounded-circle img-thumbnail" alt="" class="rounded img-thumbnail border" width="300">
                   <div class="ml-lg-5 mt-4">
                       <span>Nama Siswa : {{$name}}</span><br>
                       <span>Kelas : {{$class}}</span><br>
                       <span>Jenis Kelamin : {{$gender}}</span><br>
                       <span>Email Siswa : {{$email}}</span><br>
                       <span>No HP : {{$number_phone}}</span><br>
                       <span>Nomor Induk Sekolah : {{$nis}}</span><br>
                       <span>Nomor Induk Sekolah Nasional : {{$nisn}}</span><br>
                   </div>
               </div>

                <div class="mt-5 float-lg-right">
                   <button wire:click="$set('status', 'edit')" class="btn btn-tertiary">Sunting</button>
                   <button wire:click="destroy()" class="btn btn-danger">Hapus</button>
                </div>

            </div>

        @if($status === "edit")
            <div>
                <form wire:submit.prevent="submitForm">
                    <div class="d-lg-flex justify-content">
                        <div>
                            <img wire:loading.class="d-none" wire:target="photo" src="{{ $photo?->temporaryUrl() ?? "http://4.bp.blogspot.com/_N_mOB63qPaE/TUPPcgtg46I/AAAAAAAASK8/E2M0crA1XJs/s1600/mountain%252Bwallpaper-13.jpg"}} " class="rounded-circle img-thumbnail" class="rounded img-thumbnail border" width="300" height="300">

                            <p class="text-center">
                                <img src="https://gifimage.net/wp-content/uploads/2017/09/animated-loading-gif-2.gif" alt="loading gif" width="80" class="mt-3 d-none" wire:loading.class="d-inline" wire:target="photo">
                            </p>

                            <input wire:model="photo" type="file" class="form-control mt-4" width="70">
                        </div>
                        <div class="ml-lg-5 mt-4 d-lg-flex justify-content">
                            <div class="d-none-sm-custom">
                                <label class="mt-2 mr-4 " for="name">Nama Siswa</label><br>
                                <label class="mt-2 mr-4" for="class">Kelas</label><br>
                                <label class="mt-2 mr-4" for="gender">Jenis Kelamin Siswa</label><br>
                                <label class="mt-2 mr-4" for="email">Email Siswa</label><br>
                                <label class="mt-2 mr-4" for="number_phone">No HP Siswa</label><br>
                                <label class="mt-2 mr-4" for="nis">NIS</label><br>
                                <label class="mt-2 mr-4" for="nisn">NISN</label><br>
                            </div>
                            <div>
                                <input type="text" wire:model="name" class="form-control">
                                <select wire:model="class" id="gender" class="form-control mt-2">
                                    @foreach(\App\Models\SchoolClass::get() as $class)
                                        <option value="{{$class->class}}">{{$class->class}}</option>
                                    @endforeach
                                </select>
                                <select wire:model="gender" id="gender" class="form-control mt-2">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <input type="email" wire:model="email" class="form-control mt-2">
                                <input type="number" wire:model="number_phone" class="form-control mt-2">
                                <input type="number" wire:model="nis" class="form-control mt-2">
                                <input type="number" wire:model="nisn" class="form-control mt-2">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info mt-3" wire:loading.class="d-none" wire:target="submitForm">Sunting</button>
                    <img src="https://gifimage.net/wp-content/uploads/2017/09/animated-loading-gif-2.gif" alt="loading gif" width="80" class="mt-3 d-none" wire:loading.class="d-inline" wire:target="submitForm">
                </form>
            </div>
        @endif
        </div>
    </div>
</div>


