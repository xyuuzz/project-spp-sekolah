<div class="d-lg-flex justify-content-center">
    <div class="card p-3 mt-3" style="border-radius: 10px; min-height: 0;">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-row align-items-center">
                <div class="ms-2 c-details">
                    <h6 class="mb-0">Wali Kelas: <b>{{$this->grade}}</b></h6>
                </div>
            </div>
            <div class="badge">
                <span>{{auth()->user()->gender === "Laki-Laki" ? "Bapak" : "Ibu" . " " . auth()->user()->name}}</span>
            </div>
        </div>
        <div class="mt-5">
            <h5 class="heading">Tidak Ada Siswa Yang <br>Mengajukan Perubahan Data</h5>
        </div>
        <hr>
    </div>
</div>
