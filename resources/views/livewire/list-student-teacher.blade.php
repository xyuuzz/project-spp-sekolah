<div>
    <div class="tab-content" wire:loading.class="d-none" wire:target="showStudent">
        @include("livewire.partials.alert")
        <div class="tab-pane active show">
            <div class="d-lg-flex justify-content">
                <input wire:model="search" type="text" class="form-control col-lg-6 mb-3" placeholder="{{$placeholder_input_search}}">
                <div class="ml-lg-5 pl-lg-5 mb-4 d-flex justify-content">
                    <button wire:click="$set('choiceType', 'name')" class="btn {{$choiceType === "name" ? "btn-tertiary" : 'btn-primary'}}">Nama</button>
                    <button wire:click="$set('choiceType', 'email')" class="btn ml-2 {{$choiceType === "email" ? "btn-tertiary" : 'btn-primary'}}">Email</button>
                    <button wire:click="$set('choiceType', 'class')" class="btn ml-2 {{$choiceType === "class" ? "btn-tertiary" : 'btn-primary'}}">Kelas</button>
                    <button wire:click="$set('choiceType', 'nis')" @class([
                            "d-none" => $status === "teacher",
                            "btn",
                            "ml-2",
                            "btn-primary" => $choiceType !== "nis",
                            "btn-tertiary" => $choiceType === "nis"
                            ])>
                    NIS
                    </button>
                </div>
            </div>
            @if(method_exists($data, "perPage"))
                <div class="d-flex justify-content-center">
                    {{$data->links("livewire.partials.pagination")}}
                </div>
            @endif

            <table wire:loading.class="d-none" class="table table-hover table-responsive">
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
        <img src="http://gifimage.net/wp-content/uploads/2017/08/loading-animated-gif-1.gif" alt="" width="100" class="d-none" wire:loading.class="d-inline">
    </p>

</div>
