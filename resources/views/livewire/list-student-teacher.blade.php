<div>
    <div class="tab-content" wire:loading.class="d-none" wire:target="showStudent">
        @include("livewire.partials.alert")
        <div class="tab-pane active show">
            <div class="d-lg-flex justify-content">
                <input wire:model="search" type="search" class="form-control col-lg-6 mb-3"
                       placeholder="Cari Siswa Berdasarkan Tombol Disamping">
                <div class="ml-lg-5 pl-lg-5 mb-4 d-flex justify-content">
                    @include("livewire.list_student_teacher.button_search_type")
                </div>
            </div>

            @if(is_object($data) ? method_exists($data, "perPage") : false)
                <div class="d-flex justify-content-center">
                    {{$data->links("livewire.partials.pagination")}}
                </div>
            @endif

            <table wire:target="!loadData" wire:loading.class="d-none" class="table table-hover table-responsive">
                <thead>
                <tr class="text-center">
                    @if($status === "teacher")
                        <th scope="col">Nama Guru</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Email</th>
                        <th scope="col">Wali Kelas</th>
                        <th scope="col">Action</th>
                    @else
                        <th scope="col">Foto Siswa</th>
                        <th scope="col">Nama Siswa</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Email</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Action</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    @each("livewire.partials.table_student_teacher", $data, "data", "livewire.partials.data_table_not_found")
                </tbody>
            </table>
        </div>
    </div>

    <p class="text-center mt-5">
        <img wire:target="!loadData" wire:loading.class="d-inline" src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none" >
    </p>

</div>
