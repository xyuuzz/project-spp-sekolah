<div class="container">
    <div class="section-title">
        <h2>Buat Laporan dan Kirimkan ke Admin</h2>
    </div>

    @include("livewire.partials.alert")

    <form wire:submit.prevent="submit">
        <div class="form-group">
            <label for="about"><small class="text-danger">*</small>Perihal Laporan: </label>
            <input wire:model.defer="about" type="text" class="form-control" id="about" required maxlength="50">
            @error("about") <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label for="title"><small class="text-danger">*</small>Judul Laporan: </label>
            <input wire:model.defer="title" type="text" class="form-control" id="title" required>
            @error("title") <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <label for="content"><small class="text-danger">*</small>Isi Laporan: </label>
            <textarea wire:model.defer="content" id="content" cols="30" rows="10" class="form-control" required onkeyup="writeText(this)">

            </textarea>
            @error("content") <small class="text-danger">{{$message}}</small> @enderror
        </div>
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <label for="files">File Terkait: </label>
                <small class="text-success">Bisa Lebih dari 1 File</small>
            </div>
            <input wire:model.defer="files" id="files" type="file" class="form-control" multiple>
            @error("files.*") <small class="text-danger">{{$message}}</small> @enderror
        </div>

        <button type="submit" class="btn btn-outline-primary float-right mt-2 mr-3">Kirim</button>
    </form>
</div>
