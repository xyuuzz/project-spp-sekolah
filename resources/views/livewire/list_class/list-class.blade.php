<div class="col-lg-8">
    <div class="">
        @include("livewire.partials.alert")
    </div>

    <button wire:click="changeView" class="btn btn-outline-info">{{$view === "add" ? 'Kembali' : 'Tambahkan Kelas'}}</button>

    @if($view === "add")
        <form wire:submit.prevent="addData">
            <div class="d-lg-flex justify-content-between mt-3">
                <div>
                    <label for="class">Nama Kelas:</label>
                    <input id="class" wire:model="class" type="text" class="form-control">
                    @error("class")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div>
                    <div class="d-flex justify-content-between">
                        <label for="price">Biaya SPP: </label>
                        @if(strlen($biaya_spp))
                            <span class="text-primary">Rp. {{number_format($biaya_spp,0,',','.')}}</span>
                        @endif
                    </div>
                    <input id="price" wire:model="biaya_spp" type="number" class="form-control">
                    @error("biaya_spp")
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary float-lg-right mt-2">Tambah</button>
            </div>
        </form>
    @endif

    <div class="d-flex justify-content-center mb-3 {{$view==="add" ? "mt-4" : ""}}">
        {{$classes->links("livewire.partials.pagination")}}
    </div>
    <table class="table table-hover">
        <thead>
        <tr class="text-center">
            <th scope="col">Kelas</th>
            <th>Biaya SPP</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($classes as $class)
            @if($status === $class->class)
                @include("livewire.list_class.form_edit")
            @else
                @include("livewire.list_class.table")
            @endif

        @empty
            @include("livewire.partials.data_table_not_found")
        @endforelse
        </tbody>
    </table>
</div>
