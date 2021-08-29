@section("title", "Halaman Daftar Link Pendaftaran")
<div>
    <section class="features" id="list_link_teacher_student">
        <div class="container">
            <div class="section-title">
                <h2>Link Pendaftaran Guru Wali Kelas & Peserta Didik</h2>
                <div class="mt-3">
                    <button wire:click="changeStatus('student')"
                            class="btn btn-outline-info mr-3 {{$status === "student" ? "active" : ""}}">
                        Peserta Didik</button>
                    <button wire:click="changeStatus('teacher')" class="btn btn-outline-primary {{$status === "teacher" ? "active" : ""}}">
                        Guru Wali Kelas</button>
                </div>
            </div>
{{--            <input wire:model="search" type="text" class="form-control col-lg-6 mb-3" placeholder="">--}}
            <div wire:loading.class="d-none">
                <livewire:list-link-register-student-teacher/>
            </div>
        </div>

        <p class="text-center mt-5">
            <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none" wire:loading.class="d-inline">
        </p>
    </section>


    <section class="features" id="list_school_class">
        <div class="container">
            <div class="section-title">
                <h2>Daftar Kelas yang Ada</h2>
            </div>
            <livewire:list-class/>
        </div>

{{--        <p class="text-center mt-5">--}}
{{--            <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none" wire:loading.class="d-inline">--}}
{{--        </p>--}}
    </section>


</div>
