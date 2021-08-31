<div>
    <section id="list_teacher_student" class="features">
        <div class="container">

            <div class="section-title">
                <h2>Daftar Guru dan Siswa</h2>
            </div>

            @if(! $active_table)
                <livewire:student-action/>
            @else
                <ul class="nav nav-tabs row d-flex">
                    <li class="nav-item col-3">
                        <button wire:click="SwitchDataTable('7')" class="btn {{$active_table === "7" ? "btn-tertiary" : "nav-link"}}" style="cursor: pointer">
                            <i class="ri-gps-line"></i>
                            <h4 class="d-none d-lg-block">Siswa Kelas 7</h4>
                        </button>
                    </li>
                    <li class="nav-item col-3">
                        <button wire:click="SwitchDataTable('8')" class="btn {{$active_table === "8" ? "btn-tertiary" : "nav-link"}}" style="cursor: pointer">
                            <i class="ri-body-scan-line"></i>
                            <h4 class="d-none d-lg-block">Siswa Kelas 8</h4>
                        </button>
                    </li>
                    <li class="nav-item col-3">
                        <button wire:click="SwitchDataTable('9')" class="btn {{$active_table === "9" ? "btn-tertiary" : "nav-link"}}" style="cursor: pointer">
                            <i class="ri-sun-line"></i>
                            <h4 class="d-none d-lg-block">Siswa Kelas 9</h4>
                        </button>
                    </li>
                    <li class="nav-item col-3">
                        <button wire:click="SwitchDataTable('teacher')" class="btn {{$active_table === "teacher" ? "btn-tertiary" : "nav-link"}}" style="cursor: pointer">
                            <i class="ri-store-line"></i>
                            <h4 class="d-none d-lg-block">Guru Pengajar</h4>
                        </button>
                    </li>
                </ul>

                <livewire:list-student-teacher :grade="$active_table"/>
            @endif
        </div>
    </section>

    <section id="data_spp" class="features">
        <livewire:data-pembayaran-spp/>
    </section>

    <section id="download_spp" class="cta">
        <livewire:download-spp/>
    </section>

</div>
