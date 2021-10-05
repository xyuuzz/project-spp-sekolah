<div>
{{--    Data Siswa Satu Kelas--}}
    <section id="list_siswa" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Data Siswa</h2>
            </div>
            <livewire:list-student-teacher :grade="$grade"/>
        </div>
    </section>

{{--    Daftar Permintaan Perubahan Data Profil Siswa--}}
    <section id="list_permintaan_perubahan_data_profil" class="contact">
        <livewire:list-request-profile-data-changes :grade="$grade"/>
    </section>
</div>
