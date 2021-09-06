<div {{ $this->view === 'index' ? "class='d-flex justify-content-center'" : '' }}>

<div>
    @include("livewire.partials.alert")
    <button wire:click="$set('view', 'create')" class="btn btn-success mb-4 {{ $view==='create' ? 'd-none' : '' }}" style="cursor: pointer;">Tambahkan Link</button>
    @if(! strlen($view))
        <table class="table table-hover table-responsive">
            <thead>
            <tr class="text-center">
                <th scope="col">Copy Link</th>
                <th scope="col">Nama Link</th>
                <th scope="col">Kelas</th>
                <th scope="col">Tanggal Aktif Link</th>
                <th scope="col">Tanggal Kadaluarsa Link</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @each("livewire.list_link_register_student_teacher.table", $list_link, "link", "livewire.partials.data_table_not_found")
            </tbody>
        </table>
    @elseif($view === 'create')
        <button wire:click="backToIndexView" class="btn btn-success mb-4" style="cursor: pointer;">Kembali</button>
        <form wire:submit.prevent='submit' >
            <div class="row">
                <div class="col-lg-6">
                    <label class='mb-2' for="link">Nama Link (Opsional)</label>
                    <input id='link' wire:model='link' type="text" class="form-control">
                    @error("link")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class='mb-2' for="class">Kelas</label>
                    <select wire:model='class' id="class" class='form-control'>
                        <option>Pilih Salah satu kelas!</option>
                        @foreach(\App\Models\SchoolClass::orderBy("class")->get() as $class)
                            <option value="{{$class->class}}">{{$class->class}}</option>
                        @endforeach
                    </select>
                    @error("class")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <label class='mb-2' for="valid_form">Tanggal Aktif Link</label>
                    <input id='valid_form' wire:model='valid_from' type="date" class="form-control ">
                    @error("valid_form")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label class='mb-2' for="valid_until">Tanggal Kadaluarsa Link</label>
                    <input id='valid_until' wire:model='valid_until' type="date" class="form-control ">
                    @error("valid_until")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <button type='submit' class="btn btn-tertiary mt-3 float-lg-right">Submit</button>
        </form>
    @endif
</div>

</div>

