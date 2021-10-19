<div>
{{--    Data Siswa Satu Kelas--}}
    <section id="daftar_murid_kelas" class="contact">
        <div class="container">
            @if($view_list_student)
                <div class="section-title">
                    <h2>Data Siswa</h2>
                </div>
                <livewire:list-student-teacher :grade="$grade"/>
               {{-- @livewire('list-student-teacher', ["grade" => $grade, "data_siswa" => $data_siswa]) --}}
            @else
                <livewire:student-action/>
            @endif
        </div>
    </section>

{{--    Daftar Permintaan Perubahan Data Profil Siswa--}}
    <section id="list_permintaan_perubahan_data_profil" class="contact">
        <livewire:list-request-profile-data-changes :grade="$grade"/>
       {{-- @livewire('list-request-profile-data-changes', ["grade" => $grade, "data_siswa" => $data_siswa]) --}}
    </section>
</div>
